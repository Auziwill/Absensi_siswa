<?php

namespace App\Http\Controllers;

use App\Models\guru;
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
