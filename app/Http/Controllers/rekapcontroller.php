<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user's Siswa record
        $siswa = Siswa::where('username', Auth::user()->username)->firstOrFail();

        // Fetch absences related to the Siswa, including the associated Guru
        $rekapAbsensi = Absen::where('siswa_id', $siswa->id)->with('guru')->get();

        // Return the view with the necessary data
        return view('siswa.rekap.index', [
            'menu' => 'dashboard',
            'title' => 'Rekap Absensi ' . $siswa->nama,
            'siswa' => $siswa,
            'rekapAbsensi' => $rekapAbsensi
        ]);
    }
}