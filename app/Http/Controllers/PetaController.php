<?php

namespace App\Http\Controllers;

use App\Charts\TugasLaporChart;
use App\Models\Peta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PetaController extends Controller
{
    public function index(Request $request, TugasLaporChart $tugasLaporChart)
    {
        //get user data
        $users = Auth::user();

        //query to get petas based on tanggungjawab and anggota
        $query = Peta::query();

        if ($users->id_level == 1 || $users->id_level == 2) {
            //Admin: see all peta
        } else {
            $query->where(function ($q) use ($users) {
                $q->where('anggota', $users->name);
            });
        }

        //get filtering data from request
        $anggota = $request->input('anggota');

        if ($anggota) {
            $query->where('anggota', 'LIKE', '%' . $anggota . '%');
        }

        //get filtered petas
        $petas = $query->latest()->paginate(5);

        //render view with petas
        return view('pr.petaRisiko', compact('petas'))
            ->with('tugasLaporChart', $tugasLaporChart->build())
            ->with('users', $users)
            ->with('anggota', $anggota);
    }

    public function create()
    {
        return view('pr.tambahDokPR')->with([
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
            'jenis'     => 'required|min:1',
            'dokumen'   => 'mimes:xls,xlsx',
        ]);

        //create peta
        $user = Auth::user();
        Peta::create([
            'judul'     => $request->judul,
            'jenis'     => $request->jenis,
            'dokumen'   => $request->dokumen,
            'nama'      => $user->name,
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
    public function tampilData($id)
    {
        $petas = Peta::find($id);
        return view('pr.tampilEdit', compact('petas'))->with([
            'user' => Auth::user(),
        ]);
    }
    //Edit Data
    public function updateData(Request $request, $id)
    {
        $petas = Peta::find($id);
        //validate form
        $this->validate($request, [
            'judul'     => 'required|min:1',
            'jenis'     => 'required|min:1',
            'dokumen'   => 'mimes:xls,xlsx',
        ]);
        //update peta
        $petas->judul = $request->judul;
        $petas->jenis = $request->jenis;

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(('dokumenPR/'), $filename);
            $petas->dokumen = $filename;
        }
        $petas->save();

        return redirect()->route('petas.index')->with('success', 'Data Berhasil Diupdate!');
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
        return view('pr.detailPR', compact('petas'));
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
        if (Auth::user()->id_level == 1 || Auth::user()->id_level == 3) {
            $peta->approvalPr = 'rejected';
            $peta->save();

            return redirect()->route('detailPR', $id)->with('success', 'Dokumen berhasil ditolak');
        }
        return redirect()->route('detailPR', $id)->with('error', 'Anda tidak memiliki hak akses untuk menolak dokumen ini');
    }
}
