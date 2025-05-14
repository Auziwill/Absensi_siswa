
@extends('template_siswa.layout')
@section('title', $title)

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .btn-container {
        display: flex;
        gap: 5px; /* Jarak antar tombol lebih rapat */
        margin-bottom: 20px;
    }

    .btn-container .btn {
        padding: 10px 20px;
        font-size: 1rem;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        font-size: 1.25rem;
        text-align: center;
    }

    .table-responsive {
        margin-top: 1rem;
    }

    .img-thumbnail {
        max-width: 100px;
        height: auto;
        border-radius: 8px;
    }

    .badge {
        font-size: 0.9rem;
        padding: 5px 10px;
    }

    .container {
        margin-top: 100px; /* Tambahkan margin atas agar tidak terlalu dekat dengan navbar */
    }
</style>
@endsection

<div class="container">
    <div class="btn-container">
        <a href="{{ route('pengajuan.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Ajukan
        </a>
        <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            Pengajuann {{ $siswa->nama }}
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Bukti Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $pengajuan)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $pengajuan->keterangan }}</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d M Y') }}</td>
                        <td>
                            <span class="badge 
                                {{ $pengajuan->status === 'Disetujui' ? 'bg-success' : ($pengajuan->status === 'Ditolak' ? 'bg-danger' : 'bg-secondary') }}">
                                {{ $pengajuan->status }}
                            </span>
                        </td>
                        <td>
                            <img src="{{ asset('foto/'.$pengajuan->foto) }}" alt="Foto" class="img-thumbnail">
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada pengajuan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>