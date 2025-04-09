<?php

namespace App\Http\Controllers;

use App\Models\lokal;
use App\Models\siswa;
use Illuminate\Http\Request;

class siswacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datasiswa = Siswa::all();
        return view('admin.siswa.index', [
            'menu' => 'siswa',
            'title' => 'Data Siswa',
            'datasiswa' => $datasiswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = lokal::all();
        return view('admin.siswa.create', [
            'menu' => 'siswa',
            'title' => 'Tambah Data Siswa',
            'kelas' => $kelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'nisn' => 'required',
            'alamat' => 'required',
            'jk' => 'required',
            'no_telp' => 'required',
            'username' => 'required',
            'password' => 'required',
            'no_telp_wm' => 'required',
            'nama_wm' => 'required',
            'alamat_wm' => 'required',
            'lokal_id' => 'required',
            'user_id' => 'nullable',
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'nisn.required' => 'NISN Harus Diisi',
            'alamat.required' => 'Alamat Harus Diisi',
            'jk.required' => 'Jenis Kelamin Harus Diisi',
            'no_telp.required' => 'No _telp murid Harus Diisi',
            'username.required' => 'Username Harus Diisi',
            'password.required' => 'Password Harus Diisi',
            'no_telp_wm.required' => 'No _telp WaliMurid Harus Diisi',
            'nama_wm.required' => 'Nama WaliMurid Harus Diisi',
            'alamat_wm.required' => 'Alamat WaliMurid Harus Diisi',
            'lokal_id.required' => 'Kelas Harus Diisi',
        ]);

        $siswa  = new siswa;
        $siswa->nama = $validasi['nama'];
        $siswa->nisn = $validasi['nisn'];
        $siswa->alamat = $validasi['alamat'];
        $siswa->jk = $validasi['jk'];
        $siswa->no_telp = $validasi['no_telp'];
        $siswa->username = $validasi['username'];
        $siswa->password = bcrypt($validasi['password']);
        $siswa->no_telp_wm = $validasi['no_telp_wm'];
        $siswa->nama_wm = $validasi['nama_wm'];
        $siswa->alamat_wm = $validasi['alamat_wm'];
        $siswa->lokal_id = $validasi['lokal_id'];
        $siswa->user_id = $validasi['user_id'];
        $siswa->save();
        return redirect(route('siswa.index'));
    }

        public function show($id)
    {
        $siswa = siswa::find($id);
        return view('admin.siswa.view', [
            'menu' => 'siswa',
            'title' => 'Detail Data Siswa',
            'siswa' => $siswa
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $siswa = siswa::with('lokal')->find($id);
        $kelas = lokal::all();
        return view('admin.siswa.edit', [
            'menu' => 'siswa',
            'title' => 'Edit Data Siswa',
            'siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'nullable',
            'nisn' => 'nullable',
            'alamat' => 'nullable',
            'jk' => 'nullable',
            'no_telp' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable',
            'no_telp_wm' => 'nullable',
            'nama_wm' => 'nullable',
            'alamat_wm' => 'nullable',
            'lokal_id' => 'nullable',
            'user_id' => 'nullable',
        ]);

        $siswa = Siswa::find($id);
        $siswa->nama = $validasi['nama'] ?? $siswa->nama;
        $siswa->nisn = $validasi['nisn'] ?? $siswa->nisn;
        $siswa->alamat = $validasi['alamat'] ?? $siswa->alamat;
        $siswa->jk = $validasi['jk'] ?? $siswa->jk;
        $siswa->no_telp = $validasi['no_telp'] ?? $siswa->no_telp;
        $siswa->username = $validasi['username'] ?? $siswa->username;
        if ($request->filled('password')) {
            $siswa->password = bcrypt($validasi['password']);
        }
        $siswa->no_telp_wm = $validasi['no_telp_wm'] ?? $siswa->no_telp_wm;
        $siswa->nama_wm = $validasi['nama_wm'] ?? $siswa->nama_wm;
        $siswa->alamat_wm = $validasi['alamat_wm'] ?? $siswa->alamat_wm;
        $siswa->lokal_id = $validasi['lokal_id'] ?? $siswa->lokal_id;
        $siswa->user_id = $validasi['user_id'] ?? $siswa->user_id;
        $siswa->save();
        return redirect(route('siswa.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = siswa::find($id);
        $siswa->delete();
        return redirect(route('siswa.index'));
    }
}
