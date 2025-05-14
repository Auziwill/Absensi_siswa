
@extends('template_siswa.layout')
@section('title', 'Dashboard Siswa')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .dashboard-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f8f9fc;
        padding: 100px;
    }

    .card {
        max-width: 900px;
        width: 100%;
        margin: 0 auto;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #ffffff, #f0f2f5);
    }

    .card-header {
        background: linear-gradient(90deg, #007bff, #0056b3);
        color: white;
        text-align: center;
        padding: 30px;
        border-bottom: 5px solid #0056b3;
    }

    .card-header h4 {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
    }

    .card-header p {
        font-size: 18px;
        margin: 10px 0 0;
    }

    .card-body {
        padding: 40px;
        text-align: center;
        background-color: white;
    }

    .card-body img {
        max-width: 250px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body p {
        font-size: 20px;
        color: #555;
        margin-bottom: 30px;
    }

    .btn-container {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .btn-lg {
        padding: 15px 30px;
        font-size: 18px;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: bold;
    }

    .btn-lg i {
        margin-right: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 12px rgba(0, 86, 179, 0.4);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: white;
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        box-shadow: 0 6px 12px rgba(90, 98, 104, 0.4);
        transform: translateY(-2px);
    }
</style>
@endsection


<div class="dashboard-container">
    <div class="card">
        <div class="card-header">
            <h4>Selamat Datang, {{ Auth::user()->username }}</h4>
            <p>SMKN 1 Karang Baru</p>
        </div>
        <div class="card-body">
            <img src="https://img.freepik.com/free-vector/group-students-school_52683-43231.jpg?size=626&ext=jpg" 
                 alt="Guru Mengabsen" class="img-fluid">
            <p>Silakan pilih menu di bawah ini.</p>
            <div class="btn-container">
                <a href="{{ route('rekap.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-clipboard-list"></i> Lihat hasil absensi
                </a>
                <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-paper-plane"></i> Pengajuan Izin
                </a>
            </div>
        </div>
    </div>
</div>
