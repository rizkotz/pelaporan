<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function index()
    {
        //get anggotas
        $anggotas = Anggota::latest()->paginate(5);

        //render view with anggotas
        return view('anggotas.userAnggota', compact('anggotas'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function create(){
        return view('anggotas.tambahAnggota')->with([
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

        //create anggota
        Anggota::create([
            'nama'     => $request->nama,
            'nip'    => $request->nip,
            'nidn'     => $request->nidn,
            'jabatan'     => $request->jabatan,
        ]);

        //redirect to index
        return redirect()->route('anggotas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //tampil data
    public function tampilDataAnggota($id){
        $anggotas = Anggota::find($id);
        //dd($anggotas);
        return view('anggotas.tampilEditAnggota', compact('anggotas'))->with([
            'user' => Auth::user(),
        ]);
    }

    //Edit Data
    public function updateDataAnggota(Request $request, $id){
        $anggotas = Anggota::find($id);
        $anggotas->update($request->all());

        return redirect()->route('anggotas.index')->with('success','Data Berhasil Diupdate!');
    }

    //Searching
    public function show(Request $request){

        if($request->has('search')){
            $anggotas = Anggota::where('nama','nip','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $anggotas = Anggota::all();
        }

        return view('anggotas.userAnggota', ['anggotas' => $anggotas]);
    }

    public function search(Request $request){

        if($request->has('search')){
            $anggotas = Anggota::where('nama','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $anggotas = Anggota::all();
        }

        return view('anggotas.userAnggota', ['anggotas' => $anggotas]);
    }
}
