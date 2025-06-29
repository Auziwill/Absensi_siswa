@if(auth()->user()->role != 'admin')
    <script>
        window.location.href = "{{ route('dilarang') }}";
    </script>
@endif
@extends('template_admin.layout')
@section('title', 'Data Wali Kelas')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@endsection
@section('konten')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-gray text-primary">
                    Manajemen Data Wali Kelas
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($walikelas as $wk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $wk->tingkat_kelas ?? '-' }}</td> 
                                <td>{{ $wk->guru->nama ?? 'Guru tidak ditemukan' }}</td> 
                                <td>
                                    <a href="{{ route('walikelas.show', $wk->guru->id ?? '') }}" class='btn btn-outline-primary btn-sm'>
                                        <i class='fas fa-eye' title="show"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection