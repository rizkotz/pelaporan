<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //get users
        $users = User::latest()->paginate(5);

        //render view with users
        return view('users.userView', compact('users'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function create(){
        return view('users.tambahUser')->with([
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
            'name'     => 'required|min:3',
            'username' => 'required',
            'email' => 'required|min:4|email|unique:users',
            'nip'     => 'required|min:1',
            'nidn'     => 'required|min:1',
            'password' => 'required',
            'confirmation' => 'required|same:password',
            'level'     => 'required',
        ]);

        //create user
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nip'    => $request->nip,
            'nidn'     => $request->nidn,
            'password' => bcrypt($request->password),
            'level'     => $request->level,
        ]);

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    //tampil data
    public function tampilDataUser($id){
        $users = User::find($id);
        //dd($users);
        return view('users.tampilEdituser', compact('users'))->with([
            'user' => Auth::user(),
        ]);
    }

    //Edit Data
    public function updateDataUser(Request $request, $id){
        $users = User::find($id);
        $users->update($request->all());

        return redirect()->route('users.index')->with('success','Data Berhasil Diupdate!');
    }

    //Searching
    public function show(Request $request){

        if($request->has('search')){
            $users = User::where('nama','nip','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $users = User::all();
        }

        return view('users.userView', ['users' => $users]);
    }

    public function search(Request $request){

        if($request->has('search')){
            $users = User::where('nama','LIKE','%'.$request->search.'%')->get();
        }
        else{
            $users = User::all();
        }

        return view('users.userView', ['users' => $users]);
    }
}