<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
        /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get dokumens
        $dokumens = Dokumen::latest()->paginate(5);

        //render view with dokumens
        return view('dokumens.dokumen', compact('dokumens'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function create(){
        return view('dokumens.tambahDokumen')->with([
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
            'judul'     => 'required|min:1',
            'jenis'     => 'required|min:1',
        ]);

        //create dokumen
        Dokumen::create([
            'judul'     => $request->judul,
            'jenis'     => $request->jenis,
            'dokumen'   => $request->dokumen,
        ]);

        $dokumens = Dokumen::latest()->first();
        if($request->hasFile('dokumen')){
            $request->file('dokumen')->move('dokumen/',$request->file('dokumen')->getClientOriginalName());
            $dokumens->dokumen = $request->file('dokumen')->getClientOriginalName();
            $dokumens->save();
        }

        //redirect to index
        return redirect()->route('dokumens.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //tampil data
    public function tampilDataDokumen($id){
        $dokumens = Dokumen::find($id);
        //dd($dokumens);
        return view('dokumens.tampilEditDokumen', compact('dokumens'));
    }

    //Edit Data
    public function updateDataDokumen(Request $request, $id){
        $dokumens = Dokumen::find($id);
        $dokumens->update($request->all());

        return redirect()->route('dokumens.index')->with('success','Data Berhasil Diupdate!');
    }

    //Searching
    public function show(Request $request){

        if($request->has('search')){
            $dokumens = Dokumen::where('judul','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $dokumens = Dokumen::all();
        }

        return view('dokumens.Dokumen', ['dokumens' => $dokumens]);
    }
    public function search(Request $request){

        if($request->has('search')){
            $dokumens = Dokumen::where('judul','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $dokumens = Dokumen::all();
        }

        return view('dokumens.dokumen', ['dokumens' => $dokumens]);
    }

    public function download($id)
    {
        $dokumens = Dokumen::findOrFail($id);
        $filePath = public_path('dokumen/'.$dokumens->dokumen);

        // Verifikasi bahwa file ada sebelum mencoba mengunduh
        if (Dokumen::exists($filePath)) {
            return response()->download($filePath, $dokumens->dokumen);
        } else {
            // Redirect atau tampilkan pesan kesalahan jika file tidak ditemukan
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }
    }
}
