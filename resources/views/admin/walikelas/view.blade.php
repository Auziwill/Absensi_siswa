@extends('template_admin.layout')
@section('title', 'Show Data ' . $walikelas->nama)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data {{$walikelas->nama}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$walikelas->nama}}" disabled>
                </div>
                <div class="col-12">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control" disabled>
                        <option disabled selected value="{{$walikelas->jk}}">{{$walikelas->jk}}</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="no_telp" class="form-label">Nomor Handphone</label>
                    <input type="number" class="form-control" id="no_telp" name="no_telp" value="{{$walikelas->no_telp}}" disabled>
                </div>


                <br>
                <div class="text-end">
                    <a href="{{route('walikelas.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection