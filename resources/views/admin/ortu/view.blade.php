@extends('template_admin.layout')
@section('title', 'Show Data Ortu ' . $ortu->nama)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data Orang Tua {{$ortu->nama}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf
                <div class="col-12">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$ortu->nama}}" disabled>
                </div>
                <div class="col-12">
                    <label for="tingkat_kelas" class="form-label">Kelas Siswa</label>
                    <select name="lokal_id" id="lokal_id" class="form-control" disabled>
                        <option disabled selected value="{{ $ortu->lokal_id }}">
                            {{ $ortu->lokal ? $ortu->lokal->tingkat_kelas : 'Data tidak tersedia' }}
                        </option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="nama_wm" class="form-label">Nama Wali Murid</label>
                    <input type="text" class="form-control" id="nama_wm" name="nama_wm" value="{{$ortu->nama_wm}}" disabled>
                </div>
                <div class="col-12">
                    <label for="alamat_wm" class="form-label">Alamat Wali Murid</label>
                    <textarea name="alamat_wm" id="alamat_wm" class="form-control" disabled>{{ $ortu->alamat_wm }}</textarea>
                </div>
                <div class="col-12">
                    <label for="no_telp_wm" class="form-label">Nomor Handphone Wali Murid</label>
                    <input type="number" class="form-control" id="no_telp_wm" name="no_telp_wm" value="{{$ortu->no_telp_wm}}" disabled>
                </div>
                <br>
                <div class="text-end">
                    <a href="{{route('ortu.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection