<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Peta;
use App\Models\User;
use App\Models\DocumentHistory;
use App\Models\CommentPr;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class PetaController extends Controller
{
    public function index(Request $request, TugasLaporChart $tugasLaporChart)
    {
        //get user data yang sedang login
        $users = Auth::user();

        //query to get data peta berdasarkan anggota
        $query = Peta::query();

        if ($users->id_level == 1 || $users->id_level == 2) {
            // Admin: dapat melihat semua data
            $showAll = true;

            // Mengambil data jenis yang dikelompokkan berdasarkan jenis untuk admin
            $jenisCount = Peta::select('jenis', DB::raw('count(*) as total'))
                ->groupBy('jenis')
                ->get();
        } else {
            // Filter untuk pengguna yang mengunggah dokumen atau anggota yang ditugaskan
            $query->where(function ($q) use ($users) {
                $q->where('nama', $users->name) // Mengambil data yang diunggah oleh pengguna
                    ->orWhere('anggota','LIKE','%'.$users->name.'%'); //Menambahkan kondisi utk anggota yg ditugaskan
            });

            // Mengambil data jenis yang dikelompokkan berdasarkan jenis untuk auditee
            $jenisCount = Peta::select('jenis', DB::raw('count(*) as total'))
                ->where('nama', $users->name) // Hanya jenis yang ditambahkan oleh auditee
                ->orWhere('anggota','LIKE','%'.$users->name.'%') //Menambahkan kondisi utk anggota yg ditugaskan
                ->groupBy('jenis')
                ->get();

            $showAll = false;
        }

        //get filtering data from request
        $anggota = $request->input('anggota');

        if ($anggota) {
            $query->where('anggota', 'LIKE', '%' . $anggota . '%');
        }

        //filter berdasarkan jenis jika ada
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis', $request->jenis);
        }

        //get filtered petas
        $petas = $query->latest()->with('comment_prs.user')->paginate(5);

        //Perhitungan jumlah approve
        if ($showAll) {
            // Untuk Admin: hitung semua data
            $approvedCount = Peta::where('approvalPr', 'approved')->count();
            $rejectedCount = Peta::where('approvalPr', 'rejected')->count();
        } else {
            // Untuk Pengguna Biasa: hitung berdasarkan filter
            $approvedCount = $query->where('approvalPr', 'approved')->count();
            $rejectedCount = $query->where('approvalPr', 'rejected')->count();
        }

        $unitKerjas = UnitKerja::all();
        //render view with petas
        return view('pr.petaRisiko', compact('petas', 'approvedCount', 'rejectedCount', 'unitKerjas','jenisCount'))
            ->with('tugasLaporChart', $tugasLaporChart->build())
            ->with('users', $users)
            ->with('anggota', $anggota);
    }

    public function tabelUnitKerja($unitKerja)
    {
        // Ambil data peta risiko yang sesuai dengan unit kerja yang dipilih
        $petas = Peta::where('jenis', $unitKerja)->get();

        // Lakukan pengolahan data untuk matriks
        $matrix = [];
        foreach ($petas as $peta) {
            $key = 'R-' . $peta->skor_dampak . '-' . $peta->skor_kemungkinan;
            if (!isset($matrix[$key])) {
                $matrix[$key] = [];
            }
            $matrix[$key][] = $peta->kode_regist; // atau field lain yang ingin Anda tampilkan
        }

        return view('pr.tabelUnitKerja', compact('matrix', 'unitKerja'));
    }
    public function searchPetaRisiko(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

        // Query berdasarkan jenis
        $query = Peta::where('jenis', 'LIKE', '%' .$search. '%');

        // Filter berdasarkan hak akses pengguna
        if ($user->id_level != 1 && $user->id_level != 2) { // Misalnya, hanya super admin dan admin yang bisa melihat semua data
            $query->where(function ($query) use ($user) {
                $query->where('nama', $user->name)
                    ->orWhere('anggota', 'LIKE', '%' . $user->name . '%');
            });
        }

        // Ambil data yang sesuai dengan pencarian dan hak akses pengguna
        $petas = $query->paginate(10);

        // Hitung jumlah dokumen yang disetujui dan ditolak
        $approvedCount = $query->clone()->where('approvalPr', 'approved')->count();
        $rejectedCount = $query->clone()->where('approvalPr', 'rejected')->count();

        // Hitung jumlah data berdasarkan jenis
        $jenisCount = Peta::select('jenis', DB::raw('count(*) as total'))
            ->where('jenis', 'LIKE', '%' . $search . '%')
            ->groupBy('jenis')
            ->get();
        return view('pr.petaRisiko', compact('petas', 'approvedCount', 'rejectedCount','jenisCount'));
    }

    public function tabelMatrik()
    {
        $petas = Peta::all();

        // Mengelompokkan berdasarkan skor
        $matrix = [];
        foreach ($petas as $peta) {
            $key = 'R-' . $peta->skor_dampak . '-' . $peta->skor_kemungkinan;
            if (!isset($matrix[$key])) {
                $matrix[$key] = [];
            }
            $matrix[$key][] = $peta->kode_regist; //menggunakan kode regist
        }

        return view('pr.tabelPeta', compact('matrix'));
    }

    public function create()
    {
        $user = Auth::user();
        $unitKerjas = UnitKerja::all();

        return view('pr.tambahDokPR', compact('unitKerjas'))->with([
            'user' => $user,
            'user' => Auth::user(),
        ]);
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {

        //validate form
        $this->validate($request, [
            'judul'     => 'required|min:1',
            // 'dokumen'   => 'mimes:xls,xlsx',
            'jenis'     => 'required',
            // 'kode_regist'     => 'required',
            'iku'     => 'required',
            'sasaran'     => 'required',
            'proker'     => 'required',
            'indikator'     => 'required',
            'anggaran'     => 'required',
            'pernyataan'     => 'required',
            'kategori'     => 'required',
            'uraian'     => 'required',
            'metode'     => 'required',
            'skor_kemungkinan'     => 'required',
            'skor_dampak'     => 'required',
        ]);

        // Generate kode_regist based on unit kerja (jenis)
        $latestPeta = Peta::where('jenis', $request->jenis)->latest()->first();

        if ($latestPeta) {
            // Cek apakah kode_regist memiliki format yang valid
            $kodeParts = explode('_', $latestPeta->kode_regist);
            if (count($kodeParts) > 1) {
                $count = intval($kodeParts[1]) + 1;
            } else {
                $count = 1; // Default jika format tidak sesuai
            }
        } else {
            $count = 1; // Jika tidak ada Peta sebelumnya
        }

        $kode_regist = $request->jenis . '_' . $count;


        //create peta
        $user = Auth::user();
        Peta::create([
            'judul'     => $request->judul,
            'jenis'     => $request->jenis,
            'dokumen'   => $request->dokumen,
            'nama'      => $user->name,
            'kode_regist'     => $kode_regist,
            'iku'     => $request->iku,
            'sasaran'     => $request->sasaran,
            'proker'     => $request->proker,
            'indikator'     => $request->indikator,
            'anggaran'     => $request->anggaran,
            'pernyataan'     => $request->pernyataan,
            'kategori'     => $request->kategori,
            'uraian'     => $request->uraian,
            'metode'     => $request->metode,
            'skor_kemungkinan'     => $request->skor_kemungkinan,
            'skor_dampak'     => $request->skor_dampak,
        ]);

        $petas = Peta::latest()->first();
        // if ($request->hasFile('dokumen')) {
        //     $request->file('dokumen')->move('dokumenPR/', $request->file('dokumen')->getClientOriginalName());
        //     $petas->dokumen = $request->file('dokumen')->getClientOriginalName();
        //     $petas->save();
        // }

        //redirect to index
        return redirect()->back()->with('success', 'Dokumen berhasil ditambahkan');
    }

    //Upload sesuai unit kerja
    public function uploadDokumenByJenis(Request $request, $jenis)
    {
        $request->validate([
            'dokumen' => 'required|mimes:xls,xlsx',
        ]);

        $file = $request->file('dokumen');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(('dokumenPR/'), $fileName);

        // Simpan informasi dokumen ke database
        // Misalnya, update dokumen untuk jenis tertentu
        Peta::where('jenis', $jenis)->update(['dokumen' => $fileName]);

        return redirect()->route('petaRisikoDetail', $jenis)->with('success', 'Dokumen berhasil diunggah.');
    }

    //Edit Data
    public function updateData(Request $request, $jenis)
    {
        // Validasi form
    $this->validate($request, [
        'dokumen' => 'required|mimes:xls,xlsx',
    ]);

    // Cari data Peta berdasarkan jenis
    $petas = Peta::where('jenis', $jenis)->get();

    // Simpan riwayat dokumen lama dan update dokumen baru untuk setiap entri
    foreach ($petas as $peta) {
        // Simpan riwayat dokumen lama
        if ($peta->dokumen) {
            DocumentHistory::create([
                'peta_id' => $peta->id,
                'dokumen' => $peta->dokumen,
                'uploaded_at' => now(),
                'status' => $peta->approvalPr,
            ]);
        }

        // Update dokumen baru
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            // Debugging
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('dokumenPR/'), $filename);
                $peta->dokumen = $filename;
            } else {
                $error = $file->getErrorMessage();
                Log::error("File upload error: $error");
                return redirect()->back()->with('error', 'File upload error: ' . $error);
            }
        }

        // Update status dokumen
        $peta->approvalPr = 'Pending';
        $peta->save();
    }

    return redirect()->back()->with('success', 'Dokumen berhasil diupdate');
    }

    //Hapus Data
    public function destroy($id)
    {
        $petas = Peta::findOrFail($id);
        // Hapus file terkait jika ada
        if ($petas->dokumen) {
            Storage::delete('dokumenPR/' . $petas->dokumen);
        }
        // Hapus record dari database
        $petas->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function tugas($jenis)
    {
        // Cari data berdasarkan jenis (unit kerja)
        $peta = Peta::where('jenis', $jenis)->firstOrFail();

        // Ambil semua user untuk ditampilkan sebagai opsi penelaah
        $users = User::all();

        return view('pr.tambahPR', compact('peta', 'users', 'jenis'))->with([
            'user' => Auth::user(),
        ]);
    }
    public function tambahtugas(Request $request, $jenis)
    {
        $request->validate([
            'waktu'     => 'required|min:1',
            'anggota'     => 'required',
        ], [
            'anggota.required' => 'Anggota field is required.',
        ]);

        // Cari peta risiko berdasarkan jenis (unit kerja)
        $peta = Peta::where('jenis', $jenis)->firstOrFail();

        // Simpan tugas baru
        $peta->waktu = $request->waktu;
        $peta->anggota = $request->anggota;
        $peta->save();

        return redirect()->route('petaRisikoDetail',['jenis'=>$jenis])->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function detailPR($id)
    {
        $petas = Peta::findOrFail($id);
        $comment_prs = $petas->comment_prs()->with('user')->latest()->get();
        return view('pr.detailPR', compact('petas', 'comment_prs'));
    }

    //detail per jenis
    public function detailByJenis($jenis)
    {
        // Ambil data peta risiko berdasarkan jenis
        $data = Peta::with('comment_prs') // Memuat komentar secara eager loading
                    ->where('jenis', $jenis)
                    ->paginate(10);


        // Ambil data unit kerja untuk referensi jika diperlukan
        $unitKerja = UnitKerja::all();

        // Ambil semua komentar yang terkait dengan peta risiko berdasarkan jenis
        $comment_prs = CommentPr::whereHas('peta', function($query) use ($jenis) {
            $query->where('jenis', $jenis);
        })->get();

        return view('pr.petaRisikoDetail', compact('data', 'jenis','unitKerja','comment_prs'));
    }

    //approval
    public function approve($id)
    {
        $peta = Peta::find($id);
        if (Auth::user()->id_level == 1 || Auth::user()->id_level == 2 || Auth::user()->id_level == 3 || Auth::user()->id_level == 4 || Auth::user()->id_level == 6) {
            $currentTimestamp = now();
            $peta->approvalPr = 'approved';
            $peta->approvalPr_at = $currentTimestamp;
            $peta->save();

            return redirect()->route('petaRisikoDetail', $peta->jenis)->with('success','Dokumen berhaisl di-approve.');
        }
        return redirect()->route('petaRisikoDetail', $peta->jenis)->with('error','Anda tidak memiliki hak akses untuk approve dokumen ini.');
    }

    // Disapproval
    public function disapprove($id)
    {
        $peta = Peta::find($id);
        if (Auth::user()->id_level == 1 || Auth::user()->id_level == 2 || Auth::user()->id_level == 3 || Auth::user()->id_level == 4 || Auth::user()->id_level == 6) {
            $currentTimestamp = now();
            $peta->approvalPr = 'rejected';
            $peta->approvalPr_at = $currentTimestamp;
            $peta->save();

            return redirect()->route('petaRisikoDetail', $peta->jenis)->with('success','Dokumen berhaisl ditolak.');
        }
        return redirect()->route('petaRisikoDetail', $peta->jenis)->with('error','Anda tidak memiliki hak akses untuk menolak dokumen ini.');
    }

    //Komentar Penelaah
    public function postComment(Request $request, $id)
    {
        // $peta = Peta::findOrFail($id);

        // Validasi input komentar
        $request->validate([
            'comment' => 'required|string',
        ]);

        // Simpan komentar ke dalam database
        CommentPr::create([
            'user_id' => auth()->id(),
            'peta_id' => $id,
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }
}
