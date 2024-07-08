<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Level;
use Illuminate\Auth\Events\Registered;


class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            // if ($user->level == '1') {
            //     return redirect()->intended('beranda');
            // } elseif ($user->level == '2') {
            //     return redirect()->intended('kasir');
            // }
            return redirect()->intended('dashboard');
        }
        return view('login.view_login');
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'g-recaptcha-response.required' => 'Harap isi CAPTCHA dengan benar.',
                'g-recaptcha-response.captcha' => 'CAPTCHA yang anda masukkan salah.',
            ]
        );
        $kredensial = $request->only('username', 'password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            // if ($user->level == '1') {
            //     return redirect()->intended('beranda');
            // } elseif ($user->level == '2') {
            //     return redirect()->intended('kasir');
            // }
            if ($user) {
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Maaf username atau password anda salah',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function create()
    {
        $levels = Level::all();
        return view('login.register')->with([
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
        $this->validate($request, [
            'name'     => 'required|min:3',
            'username' => 'required',
            'email' => 'required|min:4|email|unique:users',
            'nip'     => 'required|min:1',
            'nidn'     => 'required|min:1',
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
            'nidn'     => $request->nidn,
            'password' => bcrypt($request->password),
            'id_level'     => $request->id_level,
            'bagian_auditee' => $request->bagian_auditee,
        ]);

        event(new Registered($user));
        Auth::login($user);

        //redirect to index
        return redirect('/email/verify');
    }
}
