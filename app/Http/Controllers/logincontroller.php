<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function view()
    {
        return view('utama.login');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek apakah user ini adalah guru
            $guru = guru::where('username', $user->username)->first();
            if ($guru) {
            if ($user->role === 'walikelas') {
                return redirect()->route('dashboard.walikelas');
            }
            return redirect()->route('dashboard.guru');
            }

            // Cek apakah user ini adalah siswa
            $siswa = siswa::where('username', $user->username)->first();
            if ($siswa) {
            return redirect()->route('dashboard.siswa');
            }

            // Jika user adalah admin
            if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
            }

            // Jika role tidak dikenali
            Auth::logout();
            return back()->with('loginError', 'Role tidak dikenali.');
        } else {
            return redirect()->back()->with('error', 'Username atau Password Salah');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login-view');
    }
    
    public function loginError()
    {
        return back()->with('loginError', 'Login Failed, Silahkan cek kembali username dan password anda');
    }


}