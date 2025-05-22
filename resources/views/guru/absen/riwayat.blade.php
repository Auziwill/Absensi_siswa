@if(auth()->user()->role != 'guru')
    <script>
        window.location.href = "{{ route('dilarang') }}";
    </script>
@endif

@extends('template_guru.layout')
@section('title', 'Riwayat Absensi')

@section('css')
    <style>
        div.dataTables_filter {
            text-align: right;
            margin-top: 20px;
        }

        .dt-buttons .btn {
            margin-right: 0.5rem;
            margin-top: 20px;
        }

        .no-export {
            text-align: center;
        }
    </style>
@endsection


<div class="container mt-5 pt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h3 class="mb-0">📋 Riwayat Absensi Siswa</h3>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
<br>
            <!-- Filter Kelas -->
            <form method="GET" action="{{ route('absen.riwayat') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <select name="kelas" class="form-select" onchange="this.form.submit()">
                            <option value="">🔍 Pilih Kelas</option>
                            @foreach($list_kelas as $kelas)
                                <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->tingkat_kelas }} - {{ $kelas->jurusan->nama }} - {{ $kelas->tahun_ajaran }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <!-- Tabel Absensi -->
            <div class="table-responsive mt-4">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th class="no-export">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(request('kelas'))
                            @forelse($riwayats as $absen)
                                <tr class="align-middle text-center">
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
                                            @elseif($absen->status == 'izin') bg-warning text-dark
                                            @elseif($absen->status == 'sakit') bg-info text-dark
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($absen->status) }}
                                        </span>
                                    </td>
                                    <td class="no-export">
                                        <a href="{{ route('absen.edit', $absen->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Data tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-muted">Silakan pilih kelas terlebih dahulu.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                 <br>
        <div class="text-end">
            <a href="{{route('dashboard.guru')}}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            </div>
        </div>
    </div>
</div>


@section('js')
    <!-- DataTables Libraries -->
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
                dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Riwayat Absensi Siswa',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Riwayat Absensi Siswa',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Riwayat Absensi Siswa',
                        exportOptions: {
                            columns: ':not(.no-export)'
                        }
                    }
                ],
                language: {
                    search: "🔍 Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Tidak ditemukan data yang sesuai",
                    emptyTable: "Belum ada data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data"
                }
            });
        });
    </script>
@endsection
