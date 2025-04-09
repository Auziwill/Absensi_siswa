<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use Illuminate\Http\Request;

class jurusancontroller extends Controller
{
    public function index()
    {
        $jurusan = jurusan::all();
        return view('admin.jurusan.index', [
            'menu' => 'jurusan',
            'title' => 'Data jurusan',
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
 {
        return view('admin.jurusan.create', [
            'menu' => 'jurusan',
            'title' => 'Tambah Data jurusan',
           
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
           
        ], [
            'nama.required' => 'Nama Jurusan Harus Diisi',
         
        ]);

        $jurusan = new jurusan;
        $jurusan->nama = $validasi['nama'];
      
        $jurusan->save();
        return redirect(route('jurusan.index'));
    }

    public function show($id)
    {
        $jurusan = jurusan::find($id);
        return view('admin.jurusan.view', [
            'menu' => 'jurusan',
            'title' => 'Detail Data jurusan',
            'jurusan' => $jurusan
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $jurusan = jurusan::find($id);
        return view('admin.jurusan.edit', [
            'menu' => 'jurusan',
            'title' => 'Edit Data jurusan',
            'jurusan' => $jurusan
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'nullable',

        ]);

        $jurusan = jurusan::find($id);
        $jurusan->nama = $validasi['nama'] ?? $jurusan->nama;
        $jurusan->save();
        return redirect(route('jurusan.index'));
    }

}
