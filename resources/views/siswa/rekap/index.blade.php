
@extends('template_siswa.layout')
@section('title', 'Rekap Absensi')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .container-absensi {
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        margin-top: 100px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .container-absensi h3 {
        font-weight: bold;
        font-size: 1.8rem;
        margin-bottom: 10px;
        color: #333;
    }

    .container-absensi p {
        font-size: 1rem;
        color: #666;
    }

    .icon-check {
        font-size: 50px;
        color: #007bff;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .table th {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .badge-status {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.9rem;
        border: 1px solid #ccc;
        display: inline-block;
        min-width: 80px;
        background-color: #f8f9fa;
    }

    .btn-kembali {
        margin-top: 30px;
        padding: 10px 25px;
        border-radius: 6px;
        background-color: #6c757d;
        color: #fff;
        font-size: 1rem;
    }

    .btn-kembali:hover {
        background-color: #5a6268;
        color: #fff;
    }

    .footer {
        text-align: center;
        font-size: 0.85rem;
        color: #555;
        margin-top: 50px;
    }

    .footer strong {
        font-weight: bold;
    }
</style>
@endsection

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="container-absensi">
            <div class="icon-check">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <h3>Hasil Absensi</h3>
            <p class="mb-1">SMKN 1 Karang Baru</p>

            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Status</th>
                            <th>Guru yang Mengabsen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapAbsensi->sortByDesc('tanggal_absen') as $rekap)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($rekap->tanggal_absen)->format('d/m/Y') }}</td>
                            <td>{{ $rekap->jam_absen }}</td>
                            <td>
                                <span class="badge-status">
                                    {{ $rekap->status }}
                                </span>
                            </td>
                            <td>{{ $rekap->guru->nama }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data absensi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary btn-kembali">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>