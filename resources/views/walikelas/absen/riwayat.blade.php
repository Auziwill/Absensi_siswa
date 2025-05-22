@if(auth()->user()->role != 'walikelas')
<script>
    window.location.href = "{{ route('dilarang') }}";
</script>
@endif

@extends('template_walikelas.layout')
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
    body {
        background: #e3f0fb;
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
    .card-title, .card-header h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
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
            {{-- Filter Bulan dan Tahun --}}
            <form method="GET" action="{{ route('riwayat.bulanan') }}" class="row g-3 mb-4">
                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                <div class="col-md-3">
                    <label for="bulan" class="form-label">📅 Pilih Bulan</label>
                    <select name="bulan" id="bulan" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan', date('n')) == $i ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                            @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun" class="form-label">📆 Pilih Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </form>

            {{-- Filter Kelas --}}
            <form method="GET" action="{{ route('absenWalikelas.riwayat') }}" class="mb-4">
                <input type="hidden" name="bulan" value="{{ request('bulan', date('n')) }}">
                <input type="hidden" name="tahun" value="{{ request('tahun', date('Y')) }}">
                <div class="row">
                    <div class="col-md-6">
                        <label for="kelas" class="form-label">🏫 Pilih Kelas</label>
                        <select name="kelas" class="form-select" onchange="this.form.submit()">
                            <option value="">🔍 Pilih Kelas</option>
                            @foreach($list_kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->tingkat_kelas }} - {{ $kelas->jurusan->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            {{-- Tabel Riwayat Absensi Harian --}}
            <div class="table-responsive mb-5">
                <table id="dataTable" class="table table-bordered table-striped align-middle">
                    <thead class="table-light text-center">
                        <tr>
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
                        @forelse($riwayats ?? [] as $absen)
                        <tr class="text-center align-middle">
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
            </div>

            {{-- Tabel Rekap Absensi Bulanan --}}
            @if(isset($kelas_id) && $kelas_id && isset($bulan) && isset($tahun))
            <hr class="mt-5">
            <h5 class="mt-4">📚 Absensi Bulan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h5>
            @if(isset($siswas) && count($siswas) > 0)
            @php
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $statuses = ['hadir', 'izin', 'sakit', 'alpa'];
            @endphp
            <div class="table-responsive mt-3">
                <table id="dataTableBulanan" class="table table-bordered table-striped table-sm align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th rowspan="2" class="align-middle text-center">No</th>
                            <th rowspan="2" class="align-middle text-center">Nama Siswa</th>
                            <th colspan="{{ $daysInMonth }}">Tanggal</th>
                            <th colspan="4" class="align-middle text-center">Keterangan</th>
                        </tr>
                        <tr>
                            @for($d = 1; $d <= $daysInMonth; $d++)
                                <th class="text-center">{{ $d }}</th>
                                @endfor
                                <th class="text-center">H</th>
                                <th class="text-center">I</th>
                                <th class="text-center">S</th>
                                <th class="text-center">A</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $no => $siswa)
                        @php $rekap = ['hadir'=>0, 'izin'=>0, 'sakit'=>0, 'alpa'=>0]; @endphp
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td class="text-start">{{ $siswa->nama }}</td>
                            @for($d = 1; $d <= $daysInMonth; $d++)
                                @php
                                $tgl=sprintf('%04d-%02d-%02d', $tahun, $bulan, $d);
                                $absen=$absensi->first(fn($a) => $a->siswa_id == $siswa->id && $a->tanggal_absen == $tgl);
                                $stat = $absen->status ?? '';
                                if(in_array($stat, $statuses)) $rekap[$stat]++;
                                @endphp
                                <td>
                                    @if($stat == 'hadir')
                                    <span class="text-success">H</span>
                                    @elseif($stat == 'izin')
                                    <span class="text-warning">I</span>
                                    @elseif($stat == 'sakit')
                                    <span class="text-info">S</span>
                                    @elseif($stat == 'alpa')
                                    <span class="text-danger">A</span>
                                    @else
                                    -
                                    @endif
                                </td>
                                @endfor
                                <td>{{ $rekap['hadir'] }}</td>
                                <td>{{ $rekap['izin'] }}</td>
                                <td>{{ $rekap['sakit'] }}</td>
                                <td>{{ $rekap['alpa'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-muted mt-3">Tidak ada siswa di kelas ini.</p>
            @endif
            @endif
            <div class="text-end mt-4">
                <a href="{{ route('dashboard.walikelas') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
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
        // DataTable harian tanpa tombol export
        $('#dataTable').DataTable({
            language: {
                search: "Cari:",
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

        // DataTable bulanan dengan tombol export
        $('#dataTableBulanan').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: 'Rekap Absensi Bulanan',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Rekap Absensi Bulanan',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'print',
                    title: 'Rekap Absensi Bulanan',
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