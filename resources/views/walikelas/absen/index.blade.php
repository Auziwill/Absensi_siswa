@extends('template_walikelas.layout')
@section('title', 'Absen Siswa')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<style>
    .absen-container {
        max-width: 900px;
        margin: 100px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-group {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .form-inline {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .btn-small {
        padding: 5px 15px;
        font-size: 0.9rem;
    }
</style>
@endsection

<div class="absen-container">
    <div class="card-body">
        <div class="card-header text-center">
            <h4 class="card-title">Absensi Siswa</h4>
            <p class="card-text">Silahkan pilih kelas untuk menampilkan data siswa.</p>
        </div>
    </div>

    <!-- Form Pilih Kelas -->
    <form method="GET" action="{{ route('absen.index') }}" class="d-flex align-items-center gap-2 mb-4">
        <label for="kelas" class="form-label mb-0 me-2">Pilih Kelas:</label>
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
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="hadir" {{ old("status.$siswa->id") == 'hadir' ? 'checked' : '' }} required> Hadir</label>
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="izin" {{ old("status.$siswa->id") == 'izin' ? 'checked' : '' }}> Izin</label>
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="sakit" {{ old("status.$siswa->id") == 'sakit' ? 'checked' : '' }}> Sakit</label>
                            <label><input type="radio" name="status[{{ $siswa->id }}]" value="alpa" {{ old("status.$siswa->id") == 'alpa' ? 'checked' : '' }}> Alpa</label>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end">
                    <a href="{{route('dashboard.guru')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
    </form>
</div>

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endsection