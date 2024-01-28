<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Post;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function create(){
        $anggotas = Anggota::all();
        return view('posts.tambahTugas', compact('anggotas'))->with([
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
        ]);

        $posts = Post::latest()->first();
        if($request->hasFile('dokumen')){
            $request->file('dokumen')->move('pdf/',$request->file('dokumen')->getClientOriginalName());
            $posts->dokumen = $request->file('dokumen')->getClientOriginalName();
            $posts->save();
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
