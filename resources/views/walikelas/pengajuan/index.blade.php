@extends('template_guru.layout')
@section('title', $title)
@section('konten')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Pengajuan</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $pengajuan->siswa->nama }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $pengajuan->siswa->lokal->tingkat_kelas }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td>{{ $pengajuan->tanggal_pengajuan }}</td>
            </tr>
            <tr>
                <th>Jam Absen</th>
                <td>{{ $pengajuan->jam_absen }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $pengajuan->status }}</td>
            </tr>
            <tr>
                <th>Foto</th>
                <td><img src="{{ asset('foto/' . $pengajuan->foto) }}" alt="Foto" width="100"></td>
            </tr>
        </table>
    </div>
</div>
@endsection