<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Audite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditeController extends Controller
{
    public function index()
    {
        //get audites
        $audites = Audite::latest()->paginate(5);

        //render view with audites
        return view('audites.userAudite', compact('audites'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function create(){
        return view('audites.tambahAudite')->with([
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
            'nama'     => 'required|min:1',
            'nip'     => 'required|min:1',
            'nidn'     => 'required|min:1',
            'jabatan'     => 'required|min:1',
        ]);

        //create audite
        Audite::create([
            'nama'     => $request->nama,
            'nip'    => $request->nip,
            'nidn'     => $request->nidn,
            'jabatan'     => $request->jabatan,
        ]);

        //redirect to index
        return redirect()->route('audites.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //tampil data
    public function tampilDataAudite($id){
        $audites = Audite::find($id);
        //dd($audites);
        return view('audites.tampilEditAudite', compact('audites'))->with([
            'user' => Auth::user(),
        ]);
    }

    //Edit Data
    public function updateDataAudite(Request $request, $id){
        $audites = Audite::find($id);
        $audites->update($request->all());

        return redirect()->route('audites.index')->with('success','Data Berhasil Diupdate!');
    }

    //Searching
    public function show(Request $request){

        if($request->has('search')){
            $audites = Audite::where('nama','nip','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $audites = Audite::all();
        }

        return view('audites.userAudite', ['audites' => $audites]);
    }
    public function search(Request $request){

        if($request->has('search')){
            $audites = Audite::where('nama','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $audites = Audite::all();
        }

        return view('audites.userAudite', ['audites' => $audites]);
    }
}
