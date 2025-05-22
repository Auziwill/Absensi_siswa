@if(auth()->user()->role != 'admin')
    <script>
        window.location.href = "{{ route('dilarang') }}";
    </script>
@endif
@extends('template_admin.layout')
@section('title', 'Show Data ' . $user->username)



@section('konten')
<div class="col">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Show Data {{$user->username}}</h5>

            <!-- Vertical Form -->
            <form>
                @csrf
                <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" disabled>
                </div>
                
                <div class="col-12">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" value="{{$user->role}}" disabled>
                </div>

                <br>
                <div class="text-end">
                    <a href="{{route('user.index')}}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</div>
@endsection