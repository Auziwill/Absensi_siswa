<?php

namespace App\Http\Controllers;

use App\Models\guru;

use App\Models\lokal;
use App\Models\jurusan;
use Illuminate\Http\Request;

class lokalcontroller extends Controller
{
    public function index()
    {
        $lokal = Lokal::with('guru')->get(); // Mengambil data dengan relasi
        $jurusan = Jurusan::all();

        return view('admin.lokal.index', [
            'menu' => 'lokal',
            'title' => 'Data Kelas',
            'lokal' => $lokal,
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();

        // Ambil ID wali kelas yang sudah digunakan
        $guru_terpakai = Lokal::pluck('id_guru')->toArray();

        return view('admin.lokal.create', [
            'menu' => 'lokal',
            'title' => 'Tambah Data Kelas',
            'jurusan' => $jurusan,
            'guru' => $guru,
            'guru_terpakai' => $guru_terpakai // Kirim data guru yang sudah dipakai
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required', // Angkatan (X, XI, XII, XIII)
            'id_jurusan' => 'required',
            'id_guru' => 'required'
        ], [
            'nama.required' => 'Angkatan harus dipilih',
            'id_jurusan.required' => 'Jurusan harus dipilih',
            'id_guru.required' => 'Wali kelas harus dipilih'
        ]);

        // Ambil nama jurusan berdasarkan id_jurusan
        $jurusan = Jurusan::find($validasi['id_jurusan']);

        if (!$jurusan) {
            return back()->withErrors(['id_jurusan' => 'Jurusan tidak ditemukan']);
        }

        // Gabungkan angkatan dengan nama jurusan (menggunakan huruf)
        $nama_kelas = $validasi['nama'] . ' ' . $jurusan->nama;

        // Simpan data ke database
        $lokal = new Lokal();
        $lokal->nama = $nama_kelas;
        $lokal->id_jurusan = $validasi['id_jurusan'];
        $lokal->id_guru = $validasi['id_guru'];
        $lokal->save();

        return redirect(route('lokal.index'));
    }



    public function show($id)
    {
        $jurusan = Jurusan::all();
        $guru = Guru::all();
        $lokal = Lokal::find($id);

        // Ambil ID wali kelas yang sudah digunakan
        $guru_terpakai = Lokal::pluck('id_guru')->toArray();

        return view('admin.lokal.view', [
            'menu' => 'lokal',
            'title' => 'Tambah Data Kelas',
            'jurusan' => $jurusan,
            'guru' => $guru,
            'lokal' => $lokal,
            'guru_terpakai' => $guru_terpakai // Kirim data guru yang sudah dipakai
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $lokal = Lokal::with('jurusan', 'guru')->find($id);
        $gurus = Guru::all(); // Ambil semua guru
        $jurusan = Jurusan::all();
        $guru_terpakai = Lokal::pluck('id_guru')->toArray();

        return view('admin.lokal.edit', [
            'menu' => 'lokal',
            'title' => 'Edit Data Siswa',
            'lokal' => $lokal,
            'jurusan' => $jurusan,
            'guru' => $gurus, // Kirim variabel $gurus
            'guru_terpakai' => $guru_terpakai
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'required', // Angkatan (X, XI, XII, XIII)
            'id_jurusan' => 'required',
            'id_guru' => 'required'
        ], [
            'nama.required' => 'Angkatan harus dipilih',
            'id_jurusan.required' => 'Jurusan harus dipilih',
            'id_guru.required' => 'Wali kelas harus dipilih'
        ]);

        // Ambil data kelas berdasarkan id
        $lokal = Lokal::find($id);
        if (!$lokal) {
            return back()->withErrors(['error' => 'Data tidak ditemukan']);
        }

        // Ambil nama jurusan berdasarkan id_jurusan
        $jurusan = Jurusan::find($validasi['id_jurusan']);
        if (!$jurusan) {
            return back()->withErrors(['id_jurusan' => 'Jurusan tidak ditemukan']);
        }

        // Gabungkan angkatan dengan nama jurusan (menggunakan huruf)
        $nama_kelas = $validasi['nama'] . ' ' . $jurusan->nama;

        // Update data di database
        $lokal->nama = $nama_kelas;
        $lokal->id_jurusan = $validasi['id_jurusan'];
        $lokal->id_guru = $validasi['id_guru'];
        $lokal->save();

        return redirect(route('lokal.index'))->with('success', 'Data kelas berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lokal = lokal::find($id);
        $lokal->delete();
        return redirect(route('lokal.index'));
    }   
}
