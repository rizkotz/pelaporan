<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

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
}
