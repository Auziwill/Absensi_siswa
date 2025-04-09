<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\lokal;
use App\Models\siswa;
use App\Models\jurusan;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    public function dashboardAdmin()
    {
        $jumlahSiswa = siswa::count(); // Menghitung jumlah siswa
        $jumlahGuru = guru::count(); // Menghitung jumlah guru
        $jumlahLokal = lokal::count(); // Menghitung jumlah lokal
        $jumlahJurusan = jurusan::count(); // Menghitung jumlah jurusan

        return view('admin.index', [
            'menu' => 'home',
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahGuru' => $jumlahGuru,
            'jumlahLokal' => $jumlahLokal,
            'jumlahJurusan' => $jumlahJurusan
        ]);
    }
    public function dashboardGuru()
    {
        $jumlahSiswa = siswa::count(); // Menghitung jumlah siswa
        $jumlahGuru = guru::count(); // Menghitung jumlah guru
        $jumlahLokal = lokal::count(); // Menghitung jumlah lokal
        $jumlahJurusan = jurusan::count(); // Menghitung jumlah jurusan

        return view('guru.index', [
            'menu' => 'dashboardGuru',
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahGuru' => $jumlahGuru,
            'jumlahLokal' => $jumlahLokal,
            'jumlahJurusan' => $jumlahJurusan
        ]);
    }
}
