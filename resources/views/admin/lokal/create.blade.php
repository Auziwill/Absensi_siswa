@extends('template_admin.layout')
@section('title', 'Tambah Data Kelas')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('konten')
<div class="col">
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada masalah dengan data yang disimpan.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Kelas</h5>

            <!-- Vertical Form -->
            <form class="row g-3" method="POST" action="{{ route('lokal.store') }}">
                @csrf
                <div class="col-12">
                    <label for="tingkat_kelas" class="form-label">Tingkat Kelas</label>
                    <select name="tingkat_kelas" id="tingkat_kelas" class="form-control" required>
                        <option disabled selected value="">Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                        <option value="XIII">XIII</option>
                    </select>
                </div>

            <div class="col-12">
                <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" placeholder="Masukkan Tahun Ajaran (contoh: 2023/2024)" required>
            </div>

                <div class="col-12">
                    <label for="id_jurusan" class="form-label">Jurusan</label>
                    <select name="id_jurusan" id="id_jurusan" class="form-control" required>
                        <option disabled selected value="">Pilih Jurusan</option>
                        @foreach($jurusan as $j)
                        <option value="{{$j['id']}}">{{$j['nama']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="id_guru" class="form-label">Wali Kelas</label>
                    <select name="id_guru" class="form-control" required>
                        <option disabled selected value="">Pilih Wali Kelas</option>
                        @foreach ($guru as $g)
                        <option value="{{ $g->id }}"
                            @if (in_array($g->id, $guru_terpakai)) disabled @endif>
                            {{ $g->nama }}
                        </option>
                        @endforeach
                    </select>

                </div>
                <div class="text-end">
                    <a href="{{route('lokal.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="reset" class="btn btn-warning">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection