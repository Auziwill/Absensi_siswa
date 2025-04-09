@extends('template_admin.layout')
@section('title', 'Show Data ' . $jurusan->nama)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data {{$jurusan->nama}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf

                <div class="col-12">
                    <label for="nama" class="form-label">Nama Jurusan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$jurusan->nama}}" disabled>
                </div>


                <br>
                <div class="text-end">
                    <a href="{{route('jurusan.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection