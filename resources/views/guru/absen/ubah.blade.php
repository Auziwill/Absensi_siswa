
@extends('template_guru.layout')
@section('title', 'Ubah status absen ' . $absen->siswa->nama)



<div class="container mt-5 pt-5"> <!-- Tambahkan margin-top untuk jarak dari navbar -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Edit Data {{$absen->siswa->nama}}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('absen.update', $absen->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="status">Status Siswa</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="status" name="status">
                                <option value="hadir" {{ $absen->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="sakit" {{ $absen->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="izin" {{ $absen->status == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="alpa" {{ $absen->status == 'alpa' ? 'selected' : '' }}>Alpa</option>
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <a href="{{ route('absen.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>