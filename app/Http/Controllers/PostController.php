<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpWord\IOFactory;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index(Request $request, TugasLaporChart $tugasLaporChart)
    {
        //get user data
        $users = Auth::user();

        // Initialize pendingPosts as null
        $pendingPosts = null;

        //query to get posts based on tanggungjawab and anggota
        $query = Post::query();

        // For Ketua (id_level = 3) and Superadmin (id_level = 1)
        if ($users->id_level == 1 || $users->id_level == 3) {
            $pendingPosts = $query->where('status_task', 'pending')->latest()->paginate(5);
        }

        if ($users->id_level == 1 || $users->id_level == 2) {
            //Admin: see all post
            $approvedPosts = Post::where('status_task', 'approved')->latest()->paginate(5);
        } else {
            $approvedPosts= Post::where(function ($q) use ($users) {
                $q->where('tanggungjawab', $users->name)
                    ->orWhere('anggota', 'LIKE', '%' . $users->name . '%');
            })->where('status_task', 'approved'); //Hanya tampilkan tugas yg telah diapprove
        }

        //get filtering data from request
        $tanggungjawab = $request->input('tanggungjawab');
        $anggota = $request->input('anggota');

        if ($tanggungjawab) {
            $query->where('tanggungjawab', 'LIKE', '%' . $tanggungjawab . '%')
                ->orWhere('status_task', 'approved'); //Hanya tampilkan tugas yg telah diapprove
        }
        if ($anggota) {
            $query->where('anggota', 'LIKE', '%' . $anggota . '%')
                ->orWhere('status_task', 'approved'); //Hanya tampilkan tugas yg telah diapprove
        }

        //get filtered posts
        $posts = $query->latest()->paginate(5);

        //render view with posts
        return view('posts.reviewLaporan', compact('posts','approvedPosts','pendingPosts'))
            ->with('tugasLaporChart', $tugasLaporChart->build())
            ->with('users', $users)
            ->with('tanggungjawab', $tanggungjawab)
            ->with('anggota', $anggota);
    }
    public function laporanAkhir(Request $request, TugasLaporChart $tugasLaporChart)
    {
        //get user data
        $users = Auth::user();

        //query to get posts based on tanggungjawab and anggota
        $query = Post::query();

        if ($users->id_level == 1 || $users->id_level == 2 || $users->id_level == 3 || $users->id_level == 6) {
            //Admin: see all post
        } else {
            $query->where(function ($q) use ($users) {
                $q->where('tanggungjawab', $users->name)
                    ->orWhere('anggota', 'LIKE', '%' . $users->name . '%');
            });
        }

        //get filtering data from request
        $tanggungjawab = $request->input('tanggungjawab');
        $anggota = $request->input('anggota');

        if ($tanggungjawab) {
            $query->where('tanggungjawab', 'LIKE', '%' . $tanggungjawab . '%');
        }
        if ($anggota) {
            $query->where('anggota', 'LIKE', '%' . $anggota . '%');
        }

        // Filter only posts that have laporan_akhir
        $query->whereNotNull('laporan_akhir');

        //get filtered posts
        $posts = $query->latest()->paginate(5);

        //render view with posts
        return view('posts.laporanAkhir', compact('posts'))
            ->with('tugasLaporChart', $tugasLaporChart->build())
            ->with('users', $users)
            ->with('tanggungjawab', $tanggungjawab)
            ->with('anggota', $anggota);
    }
    public function reviewKetua(Request $request, TugasLaporChart $tugasLaporChart)
    {
        //get user data
        $users = Auth::user();

        //query to get posts based on tanggungjawab and anggota
        $query = Post::query();

        if ($users->id_level == 1 || $users->id_level == 2 || $users->id_level == 3 || $users->id_level == 6) {
            //Admin: see all post
        } else {
            $query->where(function ($q) use ($users) {
                $q->where('tanggungjawab', $users->name)
                    ->orWhere('anggota', 'LIKE', '%' . $users->name . '%');
            });
        }

        //get filtering data from request
        $tanggungjawab = $request->input('tanggungjawab');
        $anggota = $request->input('anggota');

        if ($tanggungjawab) {
            $query->where('tanggungjawab', 'LIKE', '%' . $tanggungjawab . '%');
        }
        if ($anggota) {
            $query->where('anggota', 'LIKE', '%' . $anggota . '%');
        }

        //get filtered posts
        $posts = $query->latest()->paginate(5);

        //render view with posts
        return view('posts.reviewLaporanKetua', compact('posts'))
            ->with('tugasLaporChart', $tugasLaporChart->build())
            ->with('users', $users)
            ->with('tanggungjawab', $tanggungjawab)
            ->with('anggota', $anggota);
    }
    public function print()
    {
        //get posts
        $posts = Post::all();
        return view('posts.print', compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }
    public function print_id()
    {
        //get posts
        $posts = Post::all();
        return view('posts.print_id', compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }
    public function printpdf()
    {
        //get posts
        $posts = Post::all();
        $html = view('posts.printpdf', compact('posts'))->with([
            'user' => Auth::user(),
        ]);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }

    public function create()
    {
        $users = User::all();
        return view('posts.tambahTugas', compact('users'))->with([
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
            'waktu'     => 'required|min:1',
            'anggota'   => 'required',
            'tempat'     => 'required|min:1',
            'jenis'     => 'required|min:1',
            'judul'     => 'required|min:1',
            'deskripsi'     => 'required|min:1',
            'bidang'     => 'required|min:1',
            'tanggungjawab' => 'required',
            'dokumen' => 'mimes:doc,docx,pdf',
            'templateA' => 'mimes:doc,docx',
            'templateB' => 'mimes:doc,docx',
            'rubrik' => 'mimes:xls,xlsx',
            'status_task'   => 'pending',
        ], [
            'anggota.required' => 'Anggota field is required.',
            'tanggungjawab.required' => 'Tanggungjawab field is required.'
        ]);

        //create post
        Post::create([
            'waktu'     => $request->waktu,
            'anggota'   => $request->anggota,
            'tempat'    => $request->tempat,
            'jenis'     => $request->jenis,
            'judul'     => $request->judul,
            'deskripsi'  => $request->deskripsi,
            'bidang'     => $request->bidang,
            'tanggungjawab' => $request->tanggungjawab,
            'dokumen'   => $request->dokumen,
            'templateA'   => $request->templateA,
            'templateB'   => $request->templateB,
            'rubrik'   => $request->rubrik,
        ]);

        $posts = Post::latest()->first();
        if ($request->hasFile('dokumen')) {
            $request->file('dokumen')->move('dokumenrev/', $request->file('dokumen')->getClientOriginalName());
            $posts->dokumen = $request->file('dokumen')->getClientOriginalName();
            $posts->save();
        }
        if ($request->hasFile('templateA')) {
            $request->file('templateA')->move('template_berita/', $request->file('templateA')->getClientOriginalName());
            $posts->templateA = $request->file('templateA')->getClientOriginalName();
            $posts->save();
        }
        if ($request->hasFile('templateB')) {
            $request->file('templateB')->move('template_pengesahan/', $request->file('templateB')->getClientOriginalName());
            $posts->templateB = $request->file('templateB')->getClientOriginalName();
            $posts->save();
        }
        if ($request->hasFile('rubrik')) {
            $request->file('rubrik')->move('template_rubrik/', $request->file('rubrik')->getClientOriginalName());
            $posts->rubrik = $request->file('rubrik')->getClientOriginalName();
            $posts->save();
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //approval tugas
    public function approve_task($id)
    {
        $post = Post::findOrFail($id);
        $post->status_task = 'approved';
        $post->save();
        return redirect()->route('posts.index')->with(['success' => 'Tugas berhasil disetujui!']);
    }

    public function disapprove_task($id)
    {
        $post = Post::findOrFail($id);
        $post->status_task = 'rejected';
        $post->save();
        return redirect()->route('posts.index')->with(['success' => 'Tugas berhasil ditolak!']);
    }

    //submit tugas
    public function submit(Request $request, $id)
    {
        $request->validate([
            'file_type' => 'required|in:hasilReviu,hasilBerita,hasilPengesahan,hasilRubrik',
            'hasilReviu' => 'nullable|mimes:doc,docx',
            'hasilBerita' => 'nullable|mimes:doc,docx',
            'hasilPengesahan' => 'nullable|mimes:doc,docx',
            'hasilRubrik' => 'nullable|mimes:xls,xlsx',
        ]);

        $posts = Post::findOrFail($id);
        $currentTimestamp = now();
        $fileType = $request->input('file_type');

        switch ($fileType) {
            case 'hasilReviu':
                if ($request->hasFile('hasilReviu')) {
                    $file = $request->file('hasilReviu');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('hasil_reviu/'), $fileName);
                    $posts->hasilReviu = $fileName;
                    $posts->hasilReviu_uploaded_at = $currentTimestamp;
                }
                break;
            case 'hasilBerita':
                if ($request->hasFile('hasilBerita')) {
                    $file = $request->file('hasilBerita');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('hasil_berita/'), $fileName);
                    $posts->hasilBerita = $fileName;
                    $posts->hasilBerita_uploaded_at = $currentTimestamp;
                }
                break;
            case 'hasilPengesahan':
                if ($request->hasFile('hasilPengesahan')) {
                    $file = $request->file('hasilPengesahan');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('hasil_pengesahan/'), $fileName);
                    $posts->hasilPengesahan = $fileName;
                    $posts->hasilPengesahan_uploaded_at = $currentTimestamp;
                }
                break;
            case 'hasilRubrik':
                if ($request->hasFile('hasilRubrik')) {
                    $file = $request->file('hasilRubrik');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('hasil_rubrik/'), $fileName);
                    $posts->hasilRubrik = $fileName;
                    $posts->hasilRubrik_uploaded_at = $currentTimestamp;
                }
                break;
        }
        $posts->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    //submit laporan akhir
    public function submit_akhir(Request $request, $id)
    {
        $request->validate([
            'laporan_akhir' => 'required|mimes:pdf',
        ]);

        $posts = Post::findOrFail($id);

        if ($request->hasFile('laporan_akhir')) {
            $file = $request->file('laporan_akhir');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(('hasil_akhir/'), $fileName);
            $posts->laporan_akhir = $fileName;
            $posts->save();
        }

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    //koreksi ketua
    public function koreksi_ketua(Request $request, $id)
    {
        $request->validate([
            'file_type' => 'required|in:koreksiReviu,koreksiBerita,koreksiPengesahan,koreksiRubrik',
            'koreksiReviu' => 'nullable|mimes:doc,docx',
            'koreksiBerita' => 'nullable|mimes:doc,docx',
            'koreksiPengesahan' => 'nullable|mimes:doc,docx',
            'koreksiRubrik' => 'nullable|mimes:xls,xlsx',
        ]);

        $posts = Post::findOrFail($id);
        $fileType = $request->input('file_type');

        switch ($fileType) {
            case 'koreksiReviu':
                if ($request->hasFile('koreksiReviu')) {
                    $file = $request->file('koreksiReviu');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('koreksi_reviu/'), $fileName);
                    $posts->koreksiReviu = $fileName;
                }
                break;
            case 'koreksiBerita':
                if ($request->hasFile('koreksiBerita')) {
                    $file = $request->file('koreksiBerita');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('koreksi_berita/'), $fileName);
                    $posts->koreksiBerita = $fileName;
                }
                break;
            case 'koreksiPengesahan':
                if ($request->hasFile('koreksiPengesahan')) {
                    $file = $request->file('koreksiPengesahan');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('koreksi_pengesahan/'), $fileName);
                    $posts->koreksiPengesahan = $fileName;
                }
                break;
            case 'koreksiRubrik':
                if ($request->hasFile('koreksiRubrik')) {
                    $file = $request->file('koreksiRubrik');
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(('koreksi_rubrik/'), $fileName);
                    $posts->koreksiRubrik = $fileName;
                }
                break;
        }

        $posts->save();

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    //tampil data
    public function tampilData($id)
    {
        $posts = Post::find($id);
        $users = User::all();
        //dd($posts);
        return view('posts.tampilEdit', compact('posts', 'users'))->with([
            'user' => Auth::user(),
        ]);
    }

    //detail tugas
    public function detailTugas($id)
    {
        $posts = Post::find($id);
        $comments = Comment::where('post_id', $posts->id)->get();
        return view('posts.detailTugas', compact('posts', 'comments'))->with([
            'user' => Auth::user(),
        ]);
    }

    //detail tugas ketua
    public function detailTugasKetua($id)
    {
        $posts = Post::find($id);
        return view('posts.detailTugasKetua', compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }

    //approval
    public function approve($id, $type)
    {
        $post = Post::find($id);
        if (Auth::user()->id_level == 1 || Auth::user()->id_level == 3) {
            $currentTimestamp = now();
            switch ($type) {
                case 'reviu':
                    $post->approvalReviu = 'approved';
                    $post->approvalReviu_at = $currentTimestamp;
                    break;
                case 'berita':
                    $post->approvalBerita = 'approved';
                    $post->approvalBerita_at = $currentTimestamp;
                    break;
                case 'pengesahan':
                    $post->approvalPengesahan = 'approved';
                    $post->approvalPengesahan_at = $currentTimestamp;
                    break;
                case 'rubrik':
                    $post->approvalRubrik = 'approved';
                    $post->approvalRubrik_at = $currentTimestamp;
                    break;
                default:
                    return redirect()->route('detailTugasKetua', $id)->with('error', 'Tipe approval tidak valid');
            }

            $post->save();
            return redirect()->route('detailTugasKetua', $id)->with('success', 'Dokumen berhasil di-approve');
        }

        return redirect()->route('detailTugasKetua', $id)->with('error', 'Anda tidak memiliki hak akses untuk approve dokumen ini');
    }
    // Disapproval
    public function disapprove($id, $type)
    {
        $post = Post::find($id);
        if (Auth::user()->id_level == 1 || Auth::user()->id_level == 3) {
            switch ($type) {
                case 'reviu':
                    $post->approvalReviu = 'rejected';
                    break;
                case 'berita':
                    $post->approvalBerita = 'rejected';
                    break;
                case 'pengesahan':
                    $post->approvalPengesahan = 'rejected';
                    break;
                case 'rubrik':
                    $post->approvalRubrik = 'rejected';
                    break;
                default:
                    return redirect()->route('detailTugasKetua', $id)->with('error', 'Tipe approval tidak valid');
            }

            $post->save();
            return redirect()->route('detailTugasKetua', $id)->with('success', 'Dokumen berhasil ditolak');
        }

        return redirect()->route('detailTugasKetua', $id)->with('error', 'Anda tidak memiliki hak akses untuk menolak dokumen ini');
    }

    //Comment Ketua
    public function showCommentForm($id, $type)
    {
        $post = Post::findOrFail($id);
        return view('comments.create', compact('post', 'type'));
    }

    public function postComment(Request $request, $id, $type)
    {
        $post = Post::findOrFail($id);

        // Validasi input komentar
        $request->validate([
            'comment' => 'required|string',
        ]);

        // Simpan komentar ke dalam database
        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
            'type' => $type,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil disimpan.');
    }

    //Edit Data
    public function updateData(Request $request, $id)
    {
        $post = Post::find($id);

        //validate form
        $this->validate($request, [
            'waktu'     => 'required|min:1',
            'anggota'   => 'required',
            'tempat'     => 'required|min:1',
            'jenis'     => 'required|min:1',
            'judul'     => 'required|min:1',
            'deskripsi'     => 'required|min:1',
            'bidang'     => 'required|min:1',
            'tanggungjawab' => 'required',
            'dokumen' => 'mimes:doc,docx,pdf',
            'templateA' => 'mimes:doc,docx',
            'templateB' => 'mimes:doc,docx',
            'rubrik' => 'mimes:xls,xlsx',
        ], [
            'anggota.required' => 'Anggota field is required.',
            'tanggungjawab.required' => 'Tanggungjawab field is required.'
        ]);

        //update post
        $post->waktu = $request->waktu;
        $post->anggota = $request->anggota;
        $post->tempat = $request->tempat;
        $post->jenis = $request->jenis;
        $post->judul = $request->judul;
        $post->deskripsi = $request->deskripsi;
        $post->bidang = $request->bidang;
        $post->tanggungjawab = $request->tanggungjawab;

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(('dokumenrev/'), $filename);
            $post->dokumen = $filename;
        }

        if ($request->hasFile('templateA')) {
            $file = $request->file('templateA');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(('template_berita/'), $filename);
            $post->templateA = $filename;
        }

        if ($request->hasFile('templateB')) {
            $file = $request->file('templateB');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(('template_pengesahan/'), $filename);
            $post->templateB = $filename;
        }

        if ($request->hasFile('rubrik')) {
            $file = $request->file('rubrik');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(('template_rubrik/'), $filename);
            $post->rubrik = $filename;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Data Berhasil Diupdate!');
    }

    //Hapus Data
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus file terkait jika ada
        if ($post->dokumen) {
            Storage::delete('dokumenrev/' . $post->dokumen);
        }
        if ($post->templateA) {
            Storage::delete('template_berita/' . $post->templateA);
        }
        if ($post->templateB) {
            Storage::delete('template_pengesahan/' . $post->templateB);
        }
        if ($post->rubrik) {
            Storage::delete('template_rubrik/' . $post->rubrik);
        }

        // Hapus record dari database
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    //Searching
    public function show(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('judul', 'LIKE', '%' . $search . '%')
            ->orWhere('waktu', 'LIKE', '%' . $search . '%') // Sesuaikan dengan format pencarian
            ->paginate(10);

        return view('posts.reviewLaporan', compact('posts'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('judul', 'like', '%' . $search . '%')
            ->orWhere('waktu', 'like', '%' . $search . '%') // Sesuaikan dengan format pencarian
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }
    // Print Detail Tugas yang sudah dikonversi
    public function printDetailTugas($id)
    {
        $post = Post::findOrFail($id);

        // Periksa jika semua persetujuan telah disetujui
        if (
            $post->approvalReviu == 'approved' &&
            $post->approvalBerita == 'approved' &&
            $post->approvalPengesahan == 'approved' &&
            $post->approvalRubrik == 'approved'
        ) {

            // Gabungkan dokumen-dokumen
            $filePath = $this->mergeDocuments($id);

            // Unduh dokumen gabungan
            return response()->download($filePath, 'Dokumen_' . $post->id . '.docx');
        } else {
            // Jika tidak semua dokumen telah disetujui, kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return redirect()->back()->with('error', 'Tidak dapat membuat dokumen karena belum semua dokumen disetujui.');
        }
    }

    // Konversi dan merge dokumen
    public function mergeDocuments($id)
    {
        $post = Post::findOrFail($id);

        // Tentukan lokasi dokumen yang akan digabung
        $pathDokumenReviu = ('hasil_reviu/' . $post->hasilReviu);
        $pathDokumenBerita = ('hasil_berita/' . $post->hasilBerita);
        $pathDokumenPengesahan = ('hasil_pengesahan/' . $post->hasilPengesahan);

        // Buat objek PhpWord baru untuk dokumen yang digabung
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // Fungsi untuk menambahkan konten dari dokumen ke section
        $this->addContentFromDocx($phpWord, $pathDokumenReviu);
        $this->addContentFromDocx($phpWord, $pathDokumenBerita);
        $this->addContentFromDocx($phpWord, $pathDokumenPengesahan);

        // Simpan dokumen yang digabungkan ke file sementara
        $tempFile = storage_path('app/public/temp_document.docx');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return $tempFile; // Kembalikan path file dokumen yang digabung
    }

    // Fungsi untuk menambahkan konten dari file DOCX ke objek PhpWord
    private function addContentFromDocx($phpWord, $filePath)
    {
        $source = \PhpOffice\PhpWord\IOFactory::load($filePath);

        foreach ($source->getSections() as $section) {
            $newSection = $phpWord->addSection();
            foreach ($section->getElements() as $element) {
                $this->copyElement($newSection, $element);
            }
        }
    }

    // Fungsi untuk menyalin elemen ke section baru
    private function copyElement($newSection, $element)
    {
        $type = get_class($element);

        switch ($type) {
            case 'PhpOffice\PhpWord\Element\TextRun':
                $textRun = $newSection->addTextRun($element->getParagraphStyle());
                foreach ($element->getElements() as $childElement) {
                    if (method_exists($childElement, 'getText')) {
                        $textRun->addText($childElement->getText(), $childElement->getFontStyle(), $childElement->getParagraphStyle());
                    }
                }
                break;
            case 'PhpOffice\PhpWord\Element\Text':
                $newSection->addText($element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
                break;
            case 'PhpOffice\PhpWord\Element\Title':
                $newSection->addTitle($element->getText(), $element->getDepth());
                break;
            case 'PhpOffice\PhpWord\Element\Image':
                $newSection->addImage($element->getSource(), $element->getStyle());
                break;
            case 'PhpOffice\PhpWord\Element\Link':
                $newSection->addLink($element->getSource(), $element->getText(), $element->getFontStyle(), $element->getParagraphStyle());
                break;
            case 'PhpOffice\PhpWord\Element\Table':
                $newTable = $newSection->addTable($element->getStyle());
                foreach ($element->getRows() as $row) {
                    $tableRow = $newTable->addRow();
                    foreach ($row->getCells() as $cell) {
                        $tableCell = $tableRow->addCell();
                        foreach ($cell->getElements() as $cellElement) {
                            $this->copyElement($tableCell, $cellElement);
                        }
                    }
                }
                break;
            default:
                // Handle other element types as needed
                break;
        }
    }
    public function dokumenTindakLanjut()
    {
        $posts = Post::whereNotNull('dokumen_tindak_lanjut')
            ->latest()
            ->paginate(10);
        return view('posts.dokumen_tindakLanjut', compact('posts'));
    }
    public function tambahTindakLanjut($id)
    {
        $posts = Post::find($id);
        return view('posts.tambahTindakLanjut', compact('posts'));
    }

    public function storeTindakLanjut(Request $request, $id)
    {
        $request->validate([
            'dokumen_tindak_lanjut' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $posts = Post::findOrFail($id);
        $currentTimestamp = now();

        if ($request->hasFile('dokumen_tindak_lanjut')) {
            $dokumen = $request->file('dokumen_tindak_lanjut');
            $dokumenName = time() . '_' . $dokumen->getClientOriginalName();
            $dokumen->move(('dokumen_tindaklanjut/'), $dokumenName);
            $posts->judul_tindak_lanjut = 'Tindak Lanjut ' . $posts->judul;
            $posts->dokumen_tindak_lanjut = $dokumenName;
            $posts->tindakLanjut_at = $currentTimestamp;
            $posts->save();
        }
        return redirect()->route('laporanAkhir')->with('success', 'Dokumen Tindak Lanjut berhasil ditambahkan');
    }
}
