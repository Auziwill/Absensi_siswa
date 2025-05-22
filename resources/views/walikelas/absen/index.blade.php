@extends('template_walikelas.layout')
@section('title', 'Absen Siswa')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<style>
    body {
        background: #e3f0fb;
        margin-top: 100px;
    }
    .absen-container {
        max-width: 900px;
        margin: 60px auto;
        padding: 0;
    }
    .card {
        border-radius: 18px;
        box-shadow: 0 6px 32px rgba(44, 62, 80, 0.08);
        border: 1px solid #90caf9;
        background: #f5faff;
    }
    .card-header {
        background: linear-gradient(90deg, #1976d2 0%, #42a5f5 100%);
        color: #fff;
        border-radius: 18px 18px 0 0;
        padding: 32px 24px 16px 24px;
        text-align: center;
        border-bottom: 2px solid #90caf9;
    }
    .card-title {
        font-size: 2.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }
    .card-text {
        font-size: 1.1rem;
        font-weight: 400;
        margin-bottom: 0;
    }
    .form-inline {
        display: flex;
        align-items: center;
        gap: 14px;
        justify-content: center;
        margin: 24px 0 16px 0;
    }
    .form-label {
        font-weight: 600;
        color: #1976d2;
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #90caf9;
    }
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }
    .table thead {
        background: #1976d2;
        color: #fff;
        border-top: 2px solid #90caf9;
    }
    .table tbody tr:hover {
        background-color: #e3f0fb;
    }
    .btn-primary {
        background: #1976d2;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }
    .btn-primary:hover {
        background: #1565c0;
    }
    .btn-success {
        background: #42a5f5;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        color: #fff;
    }
    .btn-success:hover {
        background: #1976d2;
        color: #fff;
    }
    .btn-secondary {
        background: #b0bec5;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        color: #263238;
    }
    .btn-secondary:hover {
        background: #78909c;
        color: #fff;
    }
    .text-end {
        text-align: right;
    }
    .alert-success {
        margin-top: 16px;
        border-radius: 8px;
        background: #e3f2fd;
        color: #1565c0;
        border: 1px solid #90caf9;
    }
    .status-label {
        margin-right: 12px;
        font-weight: 500;
        color: #1976d2;
    }
    @media (max-width: 600px) {
        .absen-container { padding: 0 5px; }
        .form-inline { flex-direction: column; gap: 8px; }
    }
</style>
@endsection

<div class="absen-container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-1">Absensi Siswa</h4>
            <p class="card-text mb-0">Silakan pilih kelas untuk menampilkan data siswa dan melakukan absensi.</p>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form Pilih Kelas -->
            <form method="GET" action="{{ route('absenWalikelas.create') }}" class="form-inline mb-3">
                <label for="kelas" class="form-label mb-0">Pilih Kelas:</label>
                <select name="kelas" id="kelas" class="form-control w-auto" required>
                    <option value="">Pilih Kelas</option>
                    @foreach($lokals as $lokal)
                    <option value="{{ $lokal->id }}" {{ request('kelas') == $lokal->id ? 'selected' : '' }}>
                        {{ $lokal->tingkat_kelas }} - {{ $lokal->jurusan->nama }} - {{ $lokal->tahun_ajaran }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Tampilkan Siswa
                </button>
            </form>

            @if(request()->has('kelas') && $datasiswa->count())
            <!-- Form Absensi -->
            <form action="{{ route('absenWalikelas.membuat') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped table-hover absen-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datasiswa as $index => $siswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->nisn }}</td>
                                <td>
                                    @if($siswa->sudah_absen ?? false)
                                        <span class="text-muted">Sudah absen</span>
                                    @else
                                        <span class="status-label">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="hadir" {{ old("status.$siswa->id") == 'hadir' ? 'checked' : '' }}> Hadir
                                        </span>
                                        <span class="status-label">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="izin" {{ old("status.$siswa->id") == 'izin' ? 'checked' : '' }}> Izin
                                        </span>
                                        <span class="status-label">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="sakit" {{ old("status.$siswa->id") == 'sakit' ? 'checked' : '' }}> Sakit
                                        </span>
                                        <span class="status-label">
                                            <input type="radio" name="status[{{ $siswa->id }}]" value="alpa" {{ old("status.$siswa->id") == 'alpa' ? 'checked' : '' }}> Alpa
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="text-end">
                    <a href="{{route('dashboard.walikelas')}}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>