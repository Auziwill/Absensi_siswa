@extends('template_admin.layout')
@section('title', 'Dashboard Admin')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
@section('konten')
<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card" style="background-color:rgb(154, 205, 242);">
                <div class="card-body">
                    <h5 class="card-title">Siswa <span>| Today</span></h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $jumlahSiswa}}</h6>
                        <span class="text-muted small pt-2 ps-1">Total siswa terdaftar</span>

                    </div>
                    </div>
                </div>

                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card" style="background-color:rgb(187, 245, 192);">
                <div class="card-body">
                    <h5 class="card-title">Guru <span>| Today</span></h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-workspace"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $jumlahGuru}}</h6>
                        <span class="text-muted small pt-2 ps-1">Total Guru terdaftar</span>

                    </div>
                    </div>
                </div>

                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card info-card customers-card" style="background-color:rgb(234, 199, 142);">
                <div class="card-body">
                    <h5 class="card-title">Kelas <span>| Today</span></h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $jumlahLokal}}</h6>
                        <span class="text-muted small pt-2 ps-1">Total Kelas tersedia</span>

                    </div>
                    </div>
                </div>

                </div>
            </div>

            <div class="col-xxl-3 col-md-6">
                <div class="card info-card customers-card" style="background-color:rgb(229, 181, 236);">
                <div class="card-body">
                    <h5 class="card-title">Jurusan <span>| Today</span></h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ $jumlahJurusan}}</h6>
                        <span class="text-muted small pt-2 ps-1">Total jurusan tersedia</span>

                    </div>
                    </div>
                </div>

                </div>
            </div>

            </div>
        </div>
        </div><!-- End Left side columns -->
        <!-- Right side columns -->
        <div class="col-lg-4">


        </div><!-- End Right side columns -->
    </div>
</section>
@endsection