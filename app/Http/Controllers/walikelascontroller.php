<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\User;
use App\Models\lokal;
use App\Models\siswa;
use Illuminate\Http\Request;

class walikelascontroller extends Controller
{
    public function index()
    {
        $walikelas = Lokal::with('guru')->get(); // Mengambil data local beserta guru

        return view('admin.walikelas.index', [
            'menu' => 'walikelas',
            'title' => 'Data lokal',
            'walikelas' => $walikelas
        ]);
    }

        public function store(Request $request)
        {
            $validasi = $request->validate([
                'nama' => 'required|string|max:255',
                
                'username' => 'required|string|unique:users,username',
                'password' => 'required|string|min:8',
            ]);
    
            $user = new User;
            $user->name = $validasi['nama'];

            $user->username = $validasi['username'];
            $user->password = bcrypt($validasi['password']);
            $user->role = 'siswa';
            $user->save();
    
            return redirect()->route('admin.walikelas.index')->with('success', 'User berhasil ditambahkan');
        }
        
    public function show($id)
    {
        $walikelas = Guru::where('id', $id)->firstOrFail(); // Mengambil data guru berdasarkan ID guru

        return view('admin.walikelas.view', [
            'menu' => 'walikelas',
            'title' => 'Detail Data Walikelas',
            'walikelas' => $walikelas
        ]);
    }
}
