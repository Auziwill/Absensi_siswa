
@extends('template_guru.layout')
@section('title', 'Riwayat Absensi')


<div class="container mt-5 pt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Riwayat Absensi Siswa</h2>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $absen)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal_absen)->format('d M Y') }}</td>
                        <td>{{ $absen->siswa->nama }}</td>
                        <td>{{ $absen->siswa->nisn }}</td>
                        <td>
                            {{ $absen->siswa->lokal->tingkat_kelas }} - 
                            {{ $absen->siswa->lokal->jurusan->nama }} - 
                            {{ $absen->siswa->lokal->tahun_ajaran }}
                        </td>
                        <td>
                            <span class="badge 
                                @if($absen->status == 'hadir') bg-success 
                                @elseif($absen->status == 'izin') bg-warning 
                                @elseif($absen->status == 'sakit') bg-info 
                                @else bg-danger 
                                @endif">
                                {{ ucfirst($absen->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('absen.edit', $absen->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                           
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data absensi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
