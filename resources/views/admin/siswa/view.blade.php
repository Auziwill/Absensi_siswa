@extends('template_admin.layout')
@section('title', 'Show Data ' . $siswa->nama)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data {{$siswa->nama}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf
                <div class="col-12">
                    <label for="nisn" class="form-label">Nisn</label>
                    <input type="number" class="form-control" id="nisn" name="nisn" value="{{$siswa->nisn}}" disabled>
                </div>
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$siswa->nama}}" disabled>
                </div>
                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$siswa->username}}" disabled>
                </div>
                <div class="col-12">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="id_local" id="id_local" class="form-control" disabled>
                        <option disabled selected value="{{$siswa->local_id}}">{{ $siswa->local ? $siswa->local->nama : 'Pilih Kelas' }}</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control" disabled>
                        <option disabled selected value="{{$siswa->jk}}">{{$siswa->jk}}</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" disabled>{{ $siswa->alamat }}</textarea>
                </div>
                <div class="col-12">
                    <label for="nohp" class="form-label">Nomor Handphone</label>
                    <input type="number" class="form-control" id="nohp" name="nohp" value="{{$siswa->nohp}}" disabled>
                </div>
                <div class="col-12">
                    <label for="nama_wm" class="form-label">Nama WaliMurid</label>
                    <input type="text" class="form-control" id="nama_wm" name="nama_wm" value="{{$siswa->nama_wm}}" disabled>
                </div>
                <div class="col-12">
                    <label for="alamat_wm" class="form-label">Alamat WaliMurid</label>
                    <textarea name="alamat_wm" id="alamat_wm" class="form-control" disabled>{{ $siswa->alamat_wm }}</textarea>
                </div>
                <div class="col-12">
                    <label for="nohp_wm" class="form-label">Nomor Handphone WaliMurid</label>
                    <input type="number" class="form-control" id="nohp_wm" name="nohp_wm" value="{{$siswa->nohp_wm}}" disabled>
                </div>
                <br>
                <div class="text-end">
                    <a href="{{route('siswa.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection