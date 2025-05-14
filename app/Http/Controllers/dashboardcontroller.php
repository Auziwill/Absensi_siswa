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
        $jumlahSiswa = siswa::count(); 
        $jumlahGuru = guru::count(); 
        $jumlahLokal = lokal::count(); 
        $jumlahJurusan = jurusan::count(); 

        return view('admin.index', [
            'menu' => 'dashboardAdmin',
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahGuru' => $jumlahGuru,
            'jumlahLokal' => $jumlahLokal,
            'jumlahJurusan' => $jumlahJurusan
        ]);
    }
    public function dashboardGuru()
    {
        $jumlahSiswa = siswa::count(); 
        $jumlahGuru = guru::count(); 
        $jumlahLokal = lokal::count(); 
        $jumlahJurusan = jurusan::count(); 

        return view('guru.index', [
            'menu' => 'dashboardGuru',
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahGuru' => $jumlahGuru,
            'jumlahLokal' => $jumlahLokal,
            'jumlahJurusan' => $jumlahJurusan
        ]);
    }
    public function dashboardSiswa()
    {
        $jumlahSiswa = siswa::count(); 
        $jumlahGuru = guru::count(); 
        $jumlahLokal = lokal::count(); 
        $jumlahJurusan = jurusan::count(); 

        return view('siswa.index', [
            'menu' => 'dashboardSiswa',
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahGuru' => $jumlahGuru,
            'jumlahLokal' => $jumlahLokal,
            'jumlahJurusan' => $jumlahJurusan
        ]);
    }
    public function dashboardWalikelas()
    {
        $jumlahSiswa = siswa::count(); 
        $jumlahGuru = guru::count(); 
        $jumlahLokal = lokal::count(); 
        $jumlahJurusan = jurusan::count(); 

        return view('walikelas.index', [
            'menu' => 'dashboardWalikelas',
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahGuru' => $jumlahGuru,
            'jumlahLokal' => $jumlahLokal,
            'jumlahJurusan' => $jumlahJurusan
        ]);
    }
}
