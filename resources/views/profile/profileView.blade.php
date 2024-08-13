@extends('layout.main')
@section('title','Profil User')

@section('isi')

<div class="col-md-16 p-4 pt-2">
    <h3><i class="fa-regular fa-user mr-2"></i>PROFIL USER</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Profile</span>
        <span class="span1">User</span>
    </h4>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <table class="table table-white table-sm">
                        <tr>
                            <th class="text-left">Nama : </th><td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">Email : </th><td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">Username : </th><td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">NIP : </th><td>{{ $user->nip }}</td>
                        </tr>

                        <!-- Tambahkan konten profil lainnya sesuai kebutuhan -->
                    </table>
                </div>
            </div>
            <div class="card border-0 shadow rounded mt-3">
                <div class="card-body">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="profile_photo">Upload Foto</label>
                            <input type="file" class="form-control" name="profile_picture" id="profile_picture">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card border-0 shadow rounded">
                <h5 class="tittle-1 p-3">
                    <span class="span0">Foto</span>
                    <span class="span1">Profil :</span>
                </h5>
                <div class="card-body text-center">

                    @if($user->profile_picture)
                        <img src="/profile_pictures/{{ $user->profile_picture }}" width="150" class="img-fluid  mb-3">
                    @else
                        <p>Tidak ada foto</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection
