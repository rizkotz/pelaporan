<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        //get users
        $users = User::latest()->paginate(5);
        // $users = Level::all();

        //render view with users
        return view('users.userView', compact('users'))->with([
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        $levels = Level::all();
        return view('users.tambahUser')->with([
            'user' => Auth::user(),
            'levels' => $levels,
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
        // dd($request);
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:3',
            'username' => 'required',
            'email' => 'required|min:4|email|unique:users',
            'nip'     => 'required|min:1',
            'password' => 'required',
            'confirmation' => 'required|same:password',
            'id_level'     => 'required',
        ]);

        //create user
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nip'    => $request->nip,
            'password' => bcrypt($request->password),
            'id_level'     => $request->id_level,
        ]);

        event(new Registered($user));
        Auth::login($user);

        //redirect to index
        return redirect('/email/verify');
    }

    //tampil data
    public function tampilDataUser($id)
    {
        $users = User::find($id);
        $levels = Level::all();
        //dd($users);
        return view('users.tampilEdituser', compact('users', 'levels'))->with([
            'user' => Auth::user(),
        ]);
    }

    //Edit Data
    public function updateDataUser(Request $request, $id)
    {
        // Validasi input
        $this->validate($request, [
            'name' => 'required|min:3',
            'username' => 'required',
            'email' => 'required|min:4|email|unique:users,email,' . $id,
            'nip' => 'required|min:1',
            'id_level' => 'required',
        ]);

        // Mencari user berdasarkan ID
        $user = User::find($id);

        // Update data user kecuali password
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->nip = $request->nip;
        $user->id_level = $request->id_level;

        // Jika password diisi, hash password baru
        if ($request->filled('password')) {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('users.index')->with('success', 'Data Berhasil Diupdate!');
    }

    //Update Profil
    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|min:4|confirmed',
        ]);

        $user = User::find($id);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = ('profile_pictures/');
            $image->move($destinationPath, $name);
            $user->profile_picture = $name;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profileDataUser', $id)->with('success', 'Profile updated successfully');
    }

    //Hapus Data User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
    //Searching
    public function show(Request $request)
    {

        if ($request->has('search')) {
            $users = User::where('name', 'nip', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $users = User::all();
        }

        return view('users.userView', ['users' => $users]);
    }

    public function search(Request $request)
    {

        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('nip', 'like', '%' . $search . '%')
            ->paginate(10);
        return view('users.userView', compact('users'));
    }

    //profil user
    public function profileDataUser()
    {
        $user = auth()->user();
        if (!$user) {
            abort(404); // Jika user tidak ditemukan, tampilkan halaman 404
        }
        $levels = Level::all();
        return view('profile.profileView', compact('user', 'levels'));
    }
    public function approveUser($id)
    {
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil disetujui!');
    }

    public function disapproveUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil ditolak!');
    }
}
