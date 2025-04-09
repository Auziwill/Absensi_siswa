<?php

namespace App\Http\Controllers;

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
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check user role and redirect accordingly
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } elseif ($user->role === 'guru') {
                return redirect()->route('dashboard.guru');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('siswa.dashboard');
            } else {
                Auth::logout();
                return back()->with('loginError', 'Role tidak dikenali.');
            }
        } else {
            return $this->loginError();
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