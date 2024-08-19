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


class PetaController extends Controller
{
    public function index(Request $request, TugasLaporChart $tugasLaporChart)
    {
        //get user data yang sedang login
        $users = Auth::user();

        //query to get data peta berdasarkan anggota
        $query = Peta::query();

        if ($users->id_level == 1 || $users->id_level == 2) {
            //Admin: see all peta
            $showAll = true;
        } else {
            //filter untuk pengguna yang mengunggah dokumen atau anggota yang ditugaskan
            $query->where(function ($q) use ($users) {
                $q->where('nama', $users->name)
                    ->orWhere('anggota', 'LIKE', '%' . $users->name . '%');
            });
            $showAll = false;
        }

        //get filtering data from request
        $anggota = $request->input('anggota');

        if ($anggota) {
            $query->where('anggota', 'LIKE', '%' . $anggota . '%');
        }

        //filter berdasarkan jenis jika ada
        if ($request->has('jenis')&& $request->jenis != ''){
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
        return view('pr.petaRisiko', compact('petas', 'approvedCount', 'rejectedCount','unitKerjas'))
            ->with('tugasLaporChart', $tugasLaporChart->build())
            ->with('users', $users)
            ->with('anggota', $anggota);
    }
    public function searchPetaRisiko(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

        // Query dasar
        $query = Peta::where(function ($query) use ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('waktu', 'like', '%' . $search . '%')
                ->orWhere('nama', 'LIKE', '%' . $search . '%')
                ->orWhere('dokumen', 'LIKE', '%' . $search . '%');
        });

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

        return view('pr.petaRisiko', compact('petas', 'approvedCount', 'rejectedCount'));
    }

    public function tabelMatrik()
    {
        $petas = Peta::all();

        // Mengelompokkan berdasarkan skor
        $matrix = [];
        foreach ($petas as $peta){
            $key = 'R-' . $peta->skor_dampak . '-' . $peta->skor_kemungkinan;
            if (!isset($matrix[$key])){
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
            'dokumen'   => 'required|mimes:xls,xlsx',
            'jenis'     => 'required',
            'kode_regist'     => 'required',
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

        //create peta
        $user = Auth::user();
        Peta::create([
            'judul'     => $request->judul,
            'jenis'     => $request->jenis,
            'dokumen'   => $request->dokumen,
            'nama'      => $user->name,
            'kode_regist'     => $request->kode_regist,
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
        if ($request->hasFile('dokumen')) {
            $request->file('dokumen')->move('dokumenPR/', $request->file('dokumen')->getClientOriginalName());
            $petas->dokumen = $request->file('dokumen')->getClientOriginalName();
            $petas->save();
        }

        //redirect to index
        return redirect()->route('petas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    //tampil data
    // public function tampilData($id)
    // {
    //     $petas = Peta::find($id);
    //     return view('pr.tampilEdit', compact('petas'))->with([
    //         'user' => Auth::user(),
    //     ]);
    // }
    //Edit Data
    public function updateData(Request $request, $id)
    {
        $petas = Peta::find($id);
        //validate form
        $this->validate($request, [
            'dokumen'   => 'required|mimes:xls,xlsx',
        ]);
        // Simpan riwayat dokumen lama
        if ($petas->dokumen) {
            DocumentHistory::create([
                'peta_id' => $petas->id,
                'dokumen' => $petas->dokumen,
                'uploaded_at' => now(),
                'status' => $petas->approvalPr,
            ]);
        }
        //update peta
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(('dokumenPR/'), $filename);
            $petas->dokumen = $filename;
        }
        $petas->approvalPr = 'Pending';
        $petas->save();

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

        return redirect()->route('petas.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function tugas($id)
    {
        $petas = Peta::findOrFail($id);
        $users = User::all();
        return view('pr.tambahPR', compact('petas', 'users'))->with([
            'user' => Auth::user(),
        ]);
    }
    public function tambahtugas(Request $request, $id)
    {
        $request->validate([
            'waktu'     => 'required|min:1',
            'anggota'     => 'required',
        ], [
            'anggota.required' => 'Anggota field is required.',
        ]);

        $petas = Peta::findOrFail($id);
        $petas->waktu = $request->waktu;
        $petas->anggota = $request->anggota;
        $petas->save();

        return redirect()->route('detailPR', ['id' => $id])->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function detailPR($id)
    {
        $petas = Peta::findOrFail($id);
        $comment_prs = $petas->comment_prs()->with('user')->latest()->get();
        return view('pr.detailPR', compact('petas', 'comment_prs'));
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
            return redirect()->route('detailPR', $id)->with('success', 'Dokumen berhasil di-approve');
        }
        return redirect()->route('detailPR', $id)->with('error', 'Anda tidak memiliki hak akses untuk approve dokumen ini');
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

            return redirect()->route('detailPR', $id)->with('success', 'Dokumen berhasil ditolak');
        }
        return redirect()->route('detailPR', $id)->with('error', 'Anda tidak memiliki hak akses untuk menolak dokumen ini');
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
