<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
/*
    public function index(TugasLaporChart $tugasLaporChart){
        $data['tugasLaporChart'] = $tugasLaporChart->build();
        return view('dashboard');
    }
*/
    public function dashboard(TugasLaporChart $tugasLaporChart){
        return view('dashboard', ['tugasLaporChart'=> $tugasLaporChart->build()])->with([
            'user' => Auth::user(),
        ]);
    }

    public function search(Request $request){

        if($request->has('search')){
            $posts = Post::where('judul','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $posts = Post::all();
        }

        return view('posts.reviewLaporan', ['posts' => $posts]);
    }




}
