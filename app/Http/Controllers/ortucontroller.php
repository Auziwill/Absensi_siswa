<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class ortucontroller extends Controller
{
    public function index()
    {
        $ortu = siswa::all();
        return view('admin.ortu.index', [
            'menu' => 'ortu',
            'title' => 'Data ortu',
            'ortu' => $ortu
        ]);
    }
    public function show($id)
    {
        $ortu = siswa::find($id);
        return view('admin.ortu.view', [
            'menu' => 'ortu',
            'title' => 'Detail Data ortu',
            'ortu' => $ortu
        ]);
    }
}
