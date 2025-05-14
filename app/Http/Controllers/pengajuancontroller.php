<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Absen;
use App\Models\Lokal;
use App\Models\Siswa;
use App\Models\Mengabsen;
use App\Models\Pengajuan;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pengajuancontroller extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('username', Auth::user()->username)->firstOrFail();
        $pengajuans = Pengajuan::where('siswa_id', $siswa->id)->get();

        return view('siswa.pengajuan.index', [
            'menu' => 'pengajuan',
            'title' => 'Pengajuan ' . $siswa->nama,
            'siswa' => $siswa,
            'pengajuans' => $pengajuans
        ]);
    }

    public function create()
    {
        return view('siswa.pengajuan.create', [
            'menu' => 'pengajuan',
            'title' => 'Pengajuan Baru'
        ]);
    }

    public function store(Request $request)
    {
        $currentDate = now()->toDateString();
        $currentTime = now()->toTimeString();

        $nm = $request->foto;
        $namaFile = $nm->getClientOriginalName();

        // Get the logged-in siswa
        $siswa = Siswa::where('username', Auth::user()->username)->firstOrFail();

        // Get the id_guru from id_Lokal; of the logged-in siswa
        $lokal = Lokal::findOrFail($siswa->Lokal_id);
        $id_guru = $lokal->id_guru;

        $pengajuan = new Pengajuan();
        $pengajuan->keterangan = $request->keterangan;
        $pengajuan->tanggal_pengajuan = $currentDate;
        $pengajuan->jam_absen = $currentTime;
        $pengajuan->status = 'menunggu';
        $pengajuan->foto = $namaFile;
        $pengajuan->siswa_id = $siswa->id;
        $pengajuan->id_guru = $id_guru;

        $nm->move(public_path() . '/foto', $namaFile);
        $pengajuan->save();

        // Create a new notification for the guru
        Notification::create([
            'title' => 'Pengajuan Baru',
            'message' => 'Pengajuan baru dari ' . $siswa->nama,
            'id_pengajuan' => $pengajuan->id,
            'id_guru' => $id_guru,
            'is_read' => false, // Set is_read to false
        ]);

 return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil disimpan.');
    }

    public function index3()
    {
        $guru = Guru::where('username', Auth::user()->username)->firstOrFail();
        $pengajuans = Pengajuan::where('id_guru', $guru->id)
            ->where('status', 'menunggu') // Hanya ambil pengajuan yang belum diproses
            ->with('siswa.Lokal;')
            ->get();

        return view('walikelas.pengajuan.index', [
            'menu' => 'pengajuan',
            'title' => 'Pengajuan untuk ' . $guru->nama,
            'guru' => $guru,
            'pengajuans' => $pengajuans
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

        // Determine the status for the mengabsen table
        $absenStatus = $request->status == 'diterima' ? 'sakit' : 'alpa';

        // Check if the record already exists in the mengabsen table
        $mengabsen = Absen::where('siswa_id', $pengajuan->siswa_id)
            ->where('tanggal_absen', $pengajuan->tanggal_pengajuan)
            ->first();

        if ($mengabsen) {
            // Update the existing record
            $mengabsen->update([
                'jam_absen' => $pengajuan->jam_absen,
                'status' => $absenStatus,
                'id_guru' => $pengajuan->id_guru,
            ]);
        } else {
            // Create a new record
            Absen::create([
                'tanggal_absen' => $pengajuan->tanggal_pengajuan,
                'jam_absen' => $pengajuan->jam_absen,
                'status' => $absenStatus,
                'siswa_id' => $pengajuan->siswa_id,
                'id_guru' => $pengajuan->id_guru,
            ]);
        }

        // Mark the related notification as read
        Notification::where('id_pengajuan', $id)->update(['is_read' => true]);

        return redirect()->route('dashboard.walikelas')->with('success', 'Status pengajuan berhasil diperbarui, data absen disimpan, dan notifikasi dihapus.');
    }

    public function indexAdmin()
    {
        $pengajuans = Pengajuan::with('siswa.Lokal;')->get();

        return view('admin.pengajuan.index', [
            'menu' => 'pengajuan',
            'title' => 'Pengajuan',
            'pengajuans' => $pengajuans
        ]);
    }
}