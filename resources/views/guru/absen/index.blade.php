@extends('template_guru.layout')
@section('title', 'Data Absen')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .action-btns {
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .action-btns .btn {
        margin: 0;
    }

    .btn-custom-width {
        width: auto;
    }
</style>
@endsection
@section('konten')

<!-- Dropdown Filter -->
<form method="GET" action="{{ route('absen.index') }}" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <select name="kelas" class="form-control" onchange="this.form.submit()">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelasList as $kelas)
                <option value="{{ $kelas->id }}" {{ request ('kelas') == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->nama }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-gray text-primary">
                    Data Absensi Siswa
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($siswa as $ds)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ds->nama }}</td>
                                <td>{{ $ds->local->nama }}</td>
                                <td>
                                    <form action="{{ route('absen.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_siswa" value="{{ $ds->id }}">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Absen
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $siswa->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection