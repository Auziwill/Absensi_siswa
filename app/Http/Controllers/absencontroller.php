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
            $query->whereDate('tanggal', $request->tanggal_absen);
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

        // Ambil data siswa berdasarkan filter kelas (jika ada)
        $datasiswa = Siswa::with('lokal')
            ->when($request->kelas, function ($query) use ($request) {
                $query->where('lokal_id', $request->kelas);
            })
            ->get();

        // Kirim data ke view
        return view('guru.absen.index', [
            'lokals' => $lokals,
            'datasiswa' => $datasiswa,
        ]);
    }
    public function riwayat()
    {
        $riwayats = Absen::with(['siswa.lokal.jurusan'])->get();
        return view('guru.absen.riwayat', compact('riwayats'));
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

        

        return redirect(route('absen.riwayat'))->with('success', 'Status siswa berhasil diperbarui.');
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
            $query->whereDate('tanggal', $request->tanggal_absen);
        }

        $datasiswa = $query->get();
        $Lokals = Lokal::all();

        return view('walikelas.absen.index', [
            'menu' => 'absen',
            'title' => 'Data Absen',
            'datasiswa' => $datasiswa,
            'Lokals' => $Lokals
        ]);
    }

    public function createWalikelas(Request $request)
    {
        $query = Siswa::with('Lokal');

        if ($request->has('tingkat_kelas') && $request->tingkat_kelas != '') {
            $query->where('lokal_id', $request->tingkat_kelas);
        }

        $datasiswa = $query->get();
        $Lokals = Lokal::all();

        return view('walikelas.absen.create', [
            'menu' => 'absen',
            'title' => 'Absen Siswa',
            'datasiswa' => $datasiswa,
            'Lokals' => $Lokals
        ]);
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
        $guru = Guru::where('id_user', Auth::id())->first();
        // Get the logged-in guru

        foreach ($statuses as $id => $status) {
            $siswa = Siswa::findOrFail($id);

            // Update status in siswa table
            $siswa->status = $status;
            $siswa->save();

            // Create a new record in absens table
            absen::create([
                'tanggal_absen' => $currentDate,
                'jam_absen' => $currentTime,
                'status' => $status,
                'id_guru' => $guru->id,
                'siswa_id' => $id,
            ]);
        }

        return redirect()->route('absenWalikelas.index');
    }

    public function editWalikelas($id)
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

        $siswa = Siswa::findOrFail($absen->siswa_id);
        $siswa->status = $validasi['status'];
        $siswa->save();

        return redirect(route('absenWalikelas.index'))->with('success', 'Status siswa berhasil diperbarui.');
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
