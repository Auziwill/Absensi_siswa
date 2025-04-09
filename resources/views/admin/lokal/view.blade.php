@extends('template_admin.layout')
@section('title', 'Show Data ' . $local->nama)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data {{$lokal->nama}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf
                <div class="col-12">
                    <label for="nama" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$lokal->nama}}" disabled>
                </div>
                <div class="col-12">
                    <label for="wali_kelas" class="form-label">Wali Kelas</label>
                    <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="{{$lokal->guru->nama}}" disabled>
                </div>


                <br>
                <div class="text-end">
                    <a href="{{route('lokal.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection