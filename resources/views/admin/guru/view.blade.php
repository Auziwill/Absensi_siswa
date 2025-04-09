@extends('template_admin.layout')
@section('title', 'Show Data ' . $guru->nama)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data {{$guru->nama}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf
                <div class="col-12">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="number" class="form-control" id="nip" name="nip" value="{{$guru->nip}}" disabled>
                </div>
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$guru->nama}}" disabled>
                </div>
                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$guru->username}}" disabled>
                </div>
                <div class="col-12">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control" disabled>
                        <option disabled selected value="{{$guru->jk}}">{{$guru->jk}}</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="no_telp" class="form-label">Nomor Handphone</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="masukkan notelp" required>
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="masukkan alamat" required></textarea>
                </div>
                <div class="col-12">
                    <label for="status" class="form-label">Status</label>
                    <input type="date" class="form-control" id="status" name="status" placeholder="masukkan tanggal bergabung" required>
                </div>
                <div class="col-12">
                    <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung</label>
                    <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" placeholder="masukkan tanggal bergabung" required>
                </div>

                <br>
                <div class="text-end">
                    <a href="{{route('guru.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection