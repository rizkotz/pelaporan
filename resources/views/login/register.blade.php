<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">

    <style>
        body {
            background-image: url('{{ asset('img/LoginBackground.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="col-md-10 p-5 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Register User</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Tambahkan Detail User</span>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" placeholder="Masukkan Nama...">

                                <!-- error message untuk nama -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">USERNAME</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" placeholder="Masukkan Username...">

                                <!-- error message untuk nama -->
                                @error('username')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">EMAIL</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Masukkan Email...">

                                <!-- error message untuk merek -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">NIP</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                    name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP...">

                                <!-- error message untuk merek -->
                                @error('nip')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">PASSWORD</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" placeholder="Masukkan Password...">

                                <!-- error message untuk merek -->
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">KONFIRMASI PASSWORD</label>
                                <input type="password" class="form-control" id="confirmation" name="confirmation"
                                    placeholder="Password Confirmation">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">JABATAN</label>
                                <select id="level" name ="id_level" class="form-control">
                                    <option value="">- Pilih Jabatan -</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('id_level') == $level ? 'selected' : '' }}>{{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- error message untuk merek -->
                                @error('level')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div id="auditeeForm" style="display: none;">
                                <div class="form-group">
                                    <label class="font-weight-bold">AUDITEE BAGIAN</label>
                                    <select name="bagian_auditee" class="form-control">
                                        <option value="">- Pilih Bagian -</option>
                                        <option value="1">Bagian 1</option>
                                        <option value="2">Bagian 2</option>
                                        <option value="3">Bagian 3</option>
                                        <option value="4">Bagian 4</option>
                                        <option value="5">Bagian 5</option>
                                    </select>
                                </div>
                            </div> --}}

                            <button type="submit" class="btn btn-md btn-primary">REGISTER</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#level').change(function() {
                if ($(this).val() == '5') { // If Auditee is selected
                    $('#auditeeForm').show();
                } else {
                    $('#auditeeForm').hide();
                }
            });
        });
    </script> --}}
    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>

</body>
</html>
