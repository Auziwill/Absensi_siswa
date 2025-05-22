<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Absen;
use App\Models\Lokal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
        $query = Absen::with(['siswa', 'guru']);

        if ($request->has('tingkat_kelas') && $request->tingkat_kelas != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('lokal_id', $request->tingkat_kelas);
            });
        }

        if ($request->has('tanggal_absen') && $request->tanggal_absen != '') {
            $query->whereDate('tanggal_absen', $request->tanggal_absen);
        }

        $datasiswa = $query->paginate(10); // Adjust the number of items per page as needed
        $lokals = Lokal::all();

        return view('guru.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'datasiswa' => $datasiswa,
            'lokals' => $lokals
        ]);
    }
    public function store(Request $request)
    {
        foreach ($request->status as $siswa_id => $status) {
            Absen::where('id', $siswa_id)->update(['status' => $status]);
        }

        return redirect()->route('absen.index')->with('success', 'Absen berhasil disimpan.');
    }

    public function create(Request $request)
    {
        // Ambil data lokal (kelas) dari tabel lokals
        $lokals = Lokal::all();
        $currentDate = now()->toDateString();


        // Ambil data siswa berdasarkan filter kelas (jika ada)
        $datasiswa = Siswa::with('lokal')
            ->when($request->kelas, function ($query) use ($request) {
                $query->where('lokal_id', $request->kelas);
            })
            ->get()
            ->map(function ($siswa) use ($currentDate) {
                $siswa->sudah_absen = $siswa->absens()->whereDate('tanggal_absen', $currentDate)->exists();
                return $siswa;
            });


        // Kirim data ke view
        return view('guru.absen.index', [
            'lokals' => $lokals,
            'datasiswa' => $datasiswa,
        ]);
    }
    public function riwayat(Request $request)
    {
        $kelas_id = $request->input('kelas');
        $user = Auth::user();
        $siswa = \App\Models\Siswa::where('user_id', $user->id)->firstOrFail();

        $riwayatsQuery = \App\Models\Absen::where('siswa_id', $siswa->id)
            ->with('guru')
            ->orderBy('tanggal_absen', 'desc');

        if ($request->filled('tanggal_absen')) {
            $riwayatsQuery->whereDate('tanggal_absen', $request->tanggal);
        }
        $riwayats = $riwayatsQuery->get();

        return view('absen.riwayat', compact('riwayats'));



        $riwayats = Absen::with(['siswa.lokal.jurusan'])
            ->when($kelas_id, function ($query) use ($kelas_id) {
                $query->whereHas('siswa', function ($q) use ($kelas_id) {
                    $q->where('lokal_id', $kelas_id);
                });
            })
            ->latest()
            ->get();

        $list_kelas = Lokal::with('jurusan')->get();

        return view('guru.absen.riwayat', compact('riwayats', 'list_kelas'));
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|array',
            'status.*' => 'in:hadir,izin,sakit,alpa',
        ]);

        $statuses = $request->input('status', []);
        $currentDate = now()->toDateString();
        $currentTime = now()->toTimeString();
        $guru = Guru::where('username', Auth::user()->username)->firstOrFail();

        foreach ($statuses as $siswaId => $status) {
            // Simpan data absensi ke tabel absens
            Absen::create([
                'siswa_id' => $siswaId,
                'id_guru' => $guru->id,
                'tanggal_absen' => $currentDate,
                'jam_absen' => $currentTime,
                'status' => $status,
            ]);
        }

        return redirect()->route('absen.index')->with('success', 'Absensi berhasil disimpan.');
    }

    public function edit($id)
    {
        $absen = absen::with('siswa.Lokal')->findOrFail($id);
        return view('guru.absen.ubah', [
            'menu' => 'absen',
            'title' => 'Edit Absen',
            'absen' => $absen
        ]);
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'status' => 'required',
        ], [
            'status.required' => 'Status harus diisi',
        ]);

        $absen = absen::findOrFail($id);
        $absen->status = $validasi['status'];
        $absen->save();



        return redirect(route('absenWalikelas.riwayat'))->with('success', 'Status siswa berhasil diperbarui.');
    }

    public function indexWalikelas(Request $request)
    {
        $query = absen::with(['siswa', 'guru']);

        if ($request->has('tingkat_kelas') && $request->tingkat_kelas != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('lokal_id', $request->tingkat_kelas);
            });
        }

        if ($request->has('tanggal_absen') && $request->tanggal_absen != '') {
            $query->whereDate('tanggal_absen', $request->tanggal_absen);
        }

        $datasiswa = $query->get();
        $Lokals = Lokal::all();

        return view('walikelas.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'datasiswa' => $datasiswa,
            'lokals' => $Lokals
        ]);
    }

    public function createWalikelas(Request $request)
    {
        $lokals = Lokal::all();
        $currentDate = now()->toDateString();


        // Ambil data siswa berdasarkan filter kelas (jika ada)
        $datasiswa = Siswa::with('lokal')
            ->when($request->kelas, function ($query) use ($request) {
                $query->where('lokal_id', $request->kelas);
            })
            ->get()
            ->map(function ($siswa) use ($currentDate) {
                $siswa->sudah_absen = $siswa->absens()->whereDate('tanggal_absen', $currentDate)->exists();
                return $siswa;
            });


        // Kirim data ke view
        return view('walikelas.absen.index', [
            'lokals' => $lokals,
            'datasiswa' => $datasiswa,
        ]);
    }
    public function riwayatWalikelas(Request $request)
    {
        $kelas_id = $request->input('kelas');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Ambil riwayat absensi berdasarkan kelas
        $riwayats = Absen::with(['siswa.lokal.jurusan'])
            ->when($kelas_id, function ($query) use ($kelas_id) {
                $query->whereHas('siswa', function ($q) use ($kelas_id) {
                    $q->where('lokal_id', $kelas_id);
                });
            })
            ->latest()
            ->get();

        // Ambil daftar kelas untuk dropdown
        $list_kelas = Lokal::with('jurusan')->get();

        // Ambil data laporan bulanan jika parameter ada
        $riwayatBulanan = null;
        if ($bulan && $tahun) {
            $riwayatBulanan = Absen::with('siswa')
                ->whereMonth('tanggal_absen', $bulan)
                ->whereYear('tanggal_absen', $tahun)
                ->get();
        }

        // Kirim ke view
        return view('walikelas.absen.riwayat', compact(
            'riwayats',
            'list_kelas',
            'riwayatBulanan'
        ));
    }

    public function membuat(Request $request)
{
    $request->validate([
        'status' => 'required|array',
        'status.*' => 'in:hadir,izin,sakit,alpa',
    ]);

    $statuses = $request->input('status', []);
    $currentDate = now()->toDateString();
    $currentTime = now()->toTimeString();
    $guru = Guru::where('user_id', Auth::id())->first();

    foreach ($statuses as $id => $status) {
        $siswa = Siswa::findOrFail($id);

        // // Update status in siswa table
        // $siswa->status = $status;
        // $siswa->save();

        // Create a new record in absens table
        Absen::create([
            'tanggal_absen' => $currentDate,
            'jam_absen' => $currentTime,
            'status' => $status,
            'id_guru' => $guru->id,
            'siswa_id' => $id,
        ]);
    }

    return redirect()->route('absenWalikelas.index')->with('success', 'Absen berhasil disimpan.');
}

    public function editwalikelas($id)
    {
        $absen = absen::with('siswa.Lokal')->findOrFail($id);
        return view('walikelas.absen.ubah', [
            'menu' => 'absen',
            'title' => 'Edit Absen',
            'absen' => $absen
        ]);
    }

    public function updateWalikelas(Request $request, $id)
   {
        $validasi = $request->validate([
            'status' => 'required',
        ], [
            'status.required' => 'Status harus diisi',
        ]);

        $absen = absen::findOrFail($id);
        $absen->status = $validasi['status'];
        $absen->save();
        return redirect(route('absenWalikelas.riwayat'))->with('success', 'Status siswa berhasil diperbarui.');
    }


    public function laporanBulanan(Request $request)
    {
        $bulan = $request->bulan ?? date('n');
        $tahun = $request->tahun ?? date('Y');
        $kelas_id = $request->kelas;

        // Ambil semua kelas untuk dropdown
        $list_kelas = \App\Models\Lokal::with('jurusan')->get();

        // Ambil siswa sesuai kelas yang dipilih
        $siswas = [];
        if ($kelas_id) {
            $siswas = \App\Models\Siswa::where('lokal_id', $kelas_id)->get();
        }

        // Ambil absensi sesuai filter
        $absensi = \App\Models\Absen::whereMonth('tanggal_absen', $bulan)
            ->whereYear('tanggal_absen', $tahun)
            ->when($kelas_id, function ($query) use ($kelas_id) {
                $query->whereHas('siswa', function ($q) use ($kelas_id) {
                    $q->where('lokal_id', $kelas_id);
                });
            })
            ->get();

        // Untuk tabel harian (opsional, jika ingin tetap tampil)
        $riwayats = $absensi;

        return view('walikelas.absen.riwayat', compact(
            'list_kelas',
            'siswas',
            'absensi',
            'bulan',
            'tahun',
            'kelas_id',
            'riwayats'
        ));
    }

    public function indexSiswa(Request $request)
    {
        $query = absen::with(['siswa', 'guru']);

        if ($request->has('tingkat_kelas') && $request->tingkat_kelas != '') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('lokal_id', $request->tingkat_kelas);
            });
        }

        if ($request->has('tanggal_absen') && $request->tanggal_absen != '') {
            $query->whereDate('tanggal', $request->tanggal_absen);
        }

        $datasiswa = $query->get();
        $Lokals = Lokal::all();

        return view('admin.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'datasiswa' => $datasiswa,
            'Lokals' => $Lokals
        ]);
    }
}
