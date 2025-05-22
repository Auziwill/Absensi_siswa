@extends('template_guru.layout')
@section('title', 'Show Data Pengajuan')

@section('konten')
<div class="col">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data Pengajuan</h5>

            <!-- Vertical Form -->
            @foreach($pengajuans as $pengajuan)
            <form action="{{ route('pengajuan.updateStatus', $pengajuan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengajuan->siswa->nama }}" disabled>
                </div>
                <div class="col-12">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $pengajuan->siswa->lokal->nama }}" disabled>
                </div>
                <div class="col-12">
                    <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="text" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" value="{{ $pengajuan->tanggal_pengajuan }}" disabled>
                </div>
                <div class="col-12">
                    <label for="jam_absen" class="form-label">Jam Pengajuan</label>
                    <input type="text" class="form-control" id="jam_absen" name="jam_absen" value="{{ $pengajuan->jam_absen }}" disabled>
                </div>
                <div class="col-12">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $pengajuan->keterangan }}" disabled>
                </div>
                <div class="col-12">
                    <label for="foto" class="form-label">Bukti</label>
                    <div>
                        <img src="{{ asset('foto/' . $pengajuan->foto) }}" alt="Foto Siswa" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                </div>

                <div class="col-12">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option disabled selected>Pilih Apakah pengajuan nya diterima atau ditolak</option>
                        <option value="diterima" {{ $pengajuan->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ $pengajuan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <br>
                <div class="text-end">
                    <a href="{{ route('dashboard.walikelas') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form><!-- Vertical Form -->
            @endforeach

        </div>
    </div>
</div>
@endsection