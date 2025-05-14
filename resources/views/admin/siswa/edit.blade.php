@extends('template_admin.layout')
@section('title', 'Mengedit Data ' . $siswa->nama)
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data {{$siswa->nama}}</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="{{route('siswa.update', $siswa->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="nisn" class="form-label">Nisn</label>
                    <input type="number" class="form-control" id="nisn" name="nisn" value="{{$siswa->nisn}}">
                </div>
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$siswa->nama}}">
                </div>
                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$siswa->username}}">
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" value="{{$siswa->password}}">
                        <span class="input-group-text" onclick="togglePassword()">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="col-12">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select name="lokal_id" id="lokal_id" class="form-control">
                        <option disabled selected value="{{$siswa->lokal_id}}">{{ $siswa->lokal ? $siswa->lokal->tingkat_kelas : 'Pilih Kelas' }}</option>
                        @foreach($kelas as $k)
                        <option value="{{$k['id']}}">{{$k['tingkat_kelas']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control">
                        <option disabled selected value="{{$siswa->jk}}">{{$siswa->jk}}</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control">{{$siswa->alamat}}</textarea>
                </div>
                <div class="col-12">
                    <label for="no_telp" class="form-label">Nomor Handphone</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp" value="{{$siswa->no_telp}}">
                </div>
                <div class="col-12">
                    <label for="nama_wm" class="form-label">Nama WaliMurid</label>
                    <input type="text" class="form-control" id="nama_wm" name="nama_wm" value="{{$siswa->nama_wm}}">
                </div>
                <div class="col-12">
                    <label for="alamat_wm" class="form-label">Alamat WaliMurid</label>
                    <textarea name="alamat_wm" id="alamat_wm" class="form-control">{{$siswa->alamat_wm}}</textarea>
                </div>
                <div class="col-12">
                    <label for="no_telp_wm" class="form-label">Nomor Handphone WaliMurid</label>
                    <input type="number" class="form-control" id="no_telp_wm" name="no_telp_wm" value="{{$siswa->no_telp_wm}}">
                </div>
                <input type="hidden" name="user_id" value="3">
                <div class="text-end">
                    <a href="{{route('siswa.index')}}" class="btn btn-primary">
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
@section('js')
<script>
    function togglePassword() {
        let passwordInput = document.getElementById("password");
        let eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
</script>

@endsection