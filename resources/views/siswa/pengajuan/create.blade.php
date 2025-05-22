@if(auth()->user()->role != 'siswa')
    <script>
        window.location.href = "{{ route('dilarang') }}";
    </script>
@endif 
@extends('template_siswa.layout')
@section('title', 'Mengajukan')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .form-container {
        margin-top: 100px; /* Tambahkan margin atas agar tidak terlalu dekat dengan navbar */
        max-width: 700px; /* Lebar maksimal form */
        margin-left: auto;
        margin-right: auto;
        padding: 30px; /* Padding lebih besar untuk kenyamanan */
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9; /* Warna latar belakang yang lebih lembut */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Shadow lebih halus */
    }

    .form-container h5 {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333; /* Warna teks lebih gelap */
    }

    .form-label {
        font-weight: bold;
        color: #555; /* Warna label lebih lembut */
    }

    .btn-group {
        display: flex;
        justify-content: flex-end;
        gap: 15px; /* Jarak antar tombol lebih besar */
    }

    .btn {
        padding: 10px 20px; /* Ukuran tombol lebih besar */
        font-size: 1rem; /* Ukuran font tombol lebih besar */
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
</style>
@endsection

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Form Pengajuan</h5>

            <!-- Vertical Form -->
            <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" required>
                </div>

                <div class="btn-group mt-4">
                    <a href="{{ route('pengajuan.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="reset" class="btn btn-warning">
                        <i class="fas fa-sync-alt"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
            <!-- Vertical Form -->

        </div>
    </div>
</div>