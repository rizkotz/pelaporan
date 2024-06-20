<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
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

    public function index(TugasLaporChart $tugasLaporChart)
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.reviewLaporan', compact('posts'),
        ['tugasLaporChart'=> $tugasLaporChart->build()])->with([
            'user' => Auth::user(),
        ]);
    }
    public function print()
    {
        //get posts
        $posts = Post::all();
        return view('posts.print',compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }
    public function print_id()
    {
        //get posts
        $posts = Post::all();
        return view('posts.print_id',compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }
    public function printpdf()
    {
        //get posts
        $posts = Post::all();
        $html = view('posts.printpdf',compact('posts'))->with([
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

    public function create(){
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

    public function store(Request $request){

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
        if($request->hasFile('dokumen')){
            $request->file('dokumen')->move('dokumenrev/',$request->file('dokumen')->getClientOriginalName());
            $posts->dokumen = $request->file('dokumen')->getClientOriginalName();
            $posts->save();
        }
        if($request->hasFile('templateA')){
            $request->file('templateA')->move('template_berita/',$request->file('templateA')->getClientOriginalName());
            $posts->templateA = $request->file('templateA')->getClientOriginalName();
            $posts->save();
        }
        if($request->hasFile('templateB')){
            $request->file('templateB')->move('template_pengesahan/',$request->file('templateB')->getClientOriginalName());
            $posts->templateB = $request->file('templateB')->getClientOriginalName();
            $posts->save();
        }
        if($request->hasFile('rubrik')){
            $request->file('rubrik')->move('template_rubrik/',$request->file('rubrik')->getClientOriginalName());
            $posts->rubrik = $request->file('rubrik')->getClientOriginalName();
            $posts->save();
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //submit tugas
    public function submit(Request $request, $id){
        $request->validate([
            'hasilReviu' => 'required|mimes:doc,docx',
            'hasilBerita' => 'required|mimes:doc,docx',
            'hasilPengesahan' => 'required|mimes:doc,docx',
            'hasilRubrik' => 'required|mimes:xls,xlsx',
        ]);

        $posts = Post::findOrFail($id);

        if ($request->hasFile('hasilReviu')) {
            $file = $request->file('hasilReviu');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hasil_reviu'), $fileName);
            $posts->hasilReviu = $fileName;
            $posts->save();
        }
        if ($request->hasFile('hasilBerita')) {
            $file = $request->file('hasilBerita');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hasil_berita'), $fileName);
            $posts->hasilBerita = $fileName;
            $posts->save();
        }
        if ($request->hasFile('hasilPengesahan')) {
            $file = $request->file('hasilPengesahan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hasil_pengesahan'), $fileName);
            $posts->hasilPengesahan = $fileName;
            $posts->save();
        }
        if ($request->hasFile('hasilRubrik')) {
            $file = $request->file('hasilRubrik');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('hasil_rubrik'), $fileName);
            $posts->hasilRubrik = $fileName;
            $posts->save();
        }

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
    }

    //tampil data
    public function tampilData($id){
        $posts = Post::find($id);
        //dd($posts);
        return view('posts.tampilEdit', compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }

    //detail tugas
    public function detailTugas($id){
        $posts = Post::find($id);
        return view('posts.detailTugas', compact('posts'))->with([
            'user' => Auth::user(),
        ]);
    }

    //detail tugas ketua
    public function detailTugasKetua($id){
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
        switch ($type) {
            case 'reviu':
                $post->approvalReviu = 'approved';
                break;
            case 'berita':
                $post->approvalBerita = 'approved';
                break;
            case 'pengesahan':
                $post->approvalPengesahan = 'approved';
                break;
            case 'rubrik':
                $post->approvalRubrik = 'approved';
                break;
            default:
                return redirect()->route('detailTugasKetua', $id)->with('error', 'Tipe approval tidak valid');
        }

        $post->save();
        return redirect()->route('detailTugasKetua', $id)->with('success', 'Dokumen berhasil di-approve');
    }

    return redirect()->route('detailTugasKetua', $id)->with('error', 'Anda tidak memiliki hak akses untuk approve dokumen ini');
}

    //Edit Data
    public function updateData(Request $request, $id){
        $posts = Post::find($id);
        $posts->update($request->all());

        return redirect()->route('posts.index')->with('success','Data Berhasil Diupdate!');
    }

    //Searching
    public function show(Request $request){

        if($request->has('search')){
            $posts = Post::where('judul','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $posts = Post::all();
        }

        return view('posts.reviewLaporan', ['posts' => $posts]);
    }

      // Print Detail Tugas yang sudah dikonversi
    public function printDetailTugas($id)
    {
        $post = Post::findOrFail($id);

        // Periksa jika semua persetujuan telah disetujui
        if ($post->approvalReviu == 'approved' &&
            $post->approvalBerita == 'approved' &&
            $post->approvalPengesahan == 'approved' &&
            $post->approvalRubrik == 'approved') {

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
    $pathDokumenReviu = public_path('hasil_reviu/' . $post->hasilReviu);
    $pathDokumenBerita = public_path('hasil_berita/' . $post->hasilBerita);
    $pathDokumenPengesahan = public_path('hasil_pengesahan/' . $post->hasilPengesahan);

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
}
