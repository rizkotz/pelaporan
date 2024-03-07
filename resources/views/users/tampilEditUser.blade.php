@extends('layout.main')
@section('title','Edit Anggota')

@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Edit Data Anggota</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Tambahkan Detail Anggota</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="/updateDataAnggota/{{ $anggotas->id }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">NAMA</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $anggotas->nama }}" placeholder="Masukkan Nama...">

                            <!-- error message untuk nama -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{  $anggotas->nip }}" placeholder="Masukkan NIP...">

                            <!-- error message untuk merek -->
                            @error('nip')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">NIDN</label>
                            <input type="text" class="form-control @error('nidn') is-invalid @enderror" name="nidn" value="{{  $anggotas->nidn }}" placeholder="Masukkan NIDN...">

                            <!-- error message untuk merek -->
                            @error('nidn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">JABATAN</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{  $anggotas->jabatan }}" placeholder="Masukkan Jabatan...">

                            <!-- error message untuk merek -->
                            @error('jabatan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
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

@endsection
