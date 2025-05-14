<?php
// filepath: /c:/xampp/htdocs/absensi-siswa/app/Http/Controllers/gurucontroller.php


namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class gurucontroller extends Controller
{
    public function index()
    {
        $dataguru = Guru::all();
        return view('admin.guru.index', [
            'menu' => 'guru',
            'title' => 'Data Guru',
            'dataguru' => $dataguru
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guru.create', [
            'menu' => 'guru',
            'title' => 'Tambah Data Guru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'no_telp' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'username' => 'required',
            'password' => 'required',
            
            'user_id' => 'nullable',
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'nip.required' => 'NIP Harus Diisi',
            'no_telp.required' => 'Nomor HP Harus Diisi',
            'jk.required' => 'Jenis Kelamin Harus Diisi',
            'alamat.required' => 'Alamat Harus Diisi',
            'status.required' => 'Status Harus Diisi',
            'username.required' => 'Username Harus Diisi',
           
            'password.required' => 'Password Harus Diisi',
        ]);
        
        $user = new User();
        $user->name = 'Guru';
        $user->username = $validasi['username'];
        
        $user->password = bcrypt($validasi['password']);
        $user->role = 'guru';
        $user->save();


        $guru = new Guru;
        $guru->nama = $validasi['nama'];
        $guru->nip = $validasi['nip'];
        $guru->no_telp = $validasi['no_telp'];
        $guru->jk = $validasi['jk'];
        $guru->alamat = $validasi['alamat'];
        $guru->status = $validasi['status'];
        $guru->tanggal_bergabung = now(); // Set tanggal_bergabung to the current date
        $guru->username = $validasi['username'];
        $guru->password = bcrypt($validasi['password']);
        $guru->user_id = $user->id;
        $guru->save();
        return redirect(route('guru.index'));
    }

    public function show($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.view', [
            'menu' => 'guru',
            'title' => 'Detail Data Guru',
            'guru' => $guru
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        return view('admin.guru.edit', [
            'menu' => 'guru',
            'title' => 'Edit Data Guru',
            'guru' => $guru
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'nullable',
            'nip' => 'nullable',
            'no_telp' => 'nullable',
            'jk' => 'nullable',
            'alamat' => 'required',
            'status' => 'required',
            'tanggal_bergabung' => 'required',
            'username' => 'nullable',
            'password' => 'nullable',
            'user_id' => 'nullable',
        ]);

        $guru = Guru::find($id);
        $guru->nama = $validasi['nama'] ?? $guru->nama;
        $guru->nip = $validasi['nip'] ?? $guru->nip;
        $guru->no_telp = $validasi['no_telp'] ?? $guru->no_telp;
        $guru->jk = $validasi['jk'] ?? $guru->jk;
        $guru->alamat = $validasi['alamat'] ?? $guru->alamat;
        $guru->status = $validasi['status'] ?? $guru->status;
        $guru->tanggal_bergabung = $validasi['tanggal_bergabung'] ?? $guru->tanggal_bergabung;
        $guru->username = $validasi['username'] ?? $guru->username;
        if ($request->filled('password')) {
            $guru->password = $validasi['password'];
        }
        $guru->user_id = $validasi['user_id'] ?? $guru->user_id;
        $guru->save();
        return redirect(route('guru.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Guru::find($id);
        $guru->delete();
        return redirect(route('guru.index'));
    }
}