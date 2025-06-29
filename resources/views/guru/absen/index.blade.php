@if(auth()->user()->role != 'guru')
    <script>
        window.location.href = "{{ route('dilarang') }}";
    </script>
@endif
@extends('template_guru.layout')
@section('title', 'Absen Siswa')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<style>
    .absen-container {
        max-width: 800px;
        margin: 100px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9; /* Light background for better contrast */
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header, 
    .card-body {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-inline {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #e1e7ff; /* Highlight on hover */
    }

    .btn-group {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .text-end {
        text-align: right;
    }
</style>
@endsection

<div class="absen-container">
    <div class="card-header">
        <h4 class="card-title">Absensi Siswa</h4>
        <p class="card-text">Silahkan pilih kelas untuk menampilkan data siswa.</p>
    </div>
 @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
    <!-- Form Pilih Kelas -->
    <form method="GET" action="{{ route('absen.create') }}" class="form-inline">
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
    <form method="POST" action="{{ route('absen.updateStatus') }}">
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

                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="hadir" {{ old("status.$siswa->id") == 'hadir' ? 'checked' : '' }}> Hadir</label>
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="izin" {{ old("status.$siswa->id") == 'izin' ? 'checked' : '' }}> Izin</label>
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="sakit" {{ old("status.$siswa->id") == 'sakit' ? 'checked' : '' }}> Sakit</label>
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="alpa" {{ old("status.$siswa->id") == 'alpa' ? 'checked' : '' }}> Alpa</label>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <div class="text-end">
            <a href="{{route('dashboard.guru')}}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </form>
@endif
</div>

