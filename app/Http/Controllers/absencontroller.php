<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\absensi;
use App\Models\Lokal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua daftar kelas dari tabel lokals
        $kelasList = Lokal::all();

        // Query awal untuk mengambil data siswa dengan relasi ke lokal
        $query = Siswa::with('lokal');

        // Jika ada filter kelas, tambahkan kondisi penyaringan
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('id_lokal', $request->kelas);
        }

        // Eksekusi query dengan paginasi
        $siswa = $query->paginate(10);

        return view('guru.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'siswa' => $siswa,
            'kelasList' => $kelasList
        ]);
    }

    public function store(Request $request)
    {
        // Menyimpan absensi dengan data siswa dan guru yang login
        absensi::create([
            'id_siswa' => $request->id_siswa,
            'id_guru' => Auth::id() // Menggunakan ID guru yang login
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil dilakukan!');
    }
}