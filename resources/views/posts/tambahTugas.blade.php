@extends('layout.main')
@section('title','tambahTugas')

@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Tambah Tugas</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Tambahkan Detail Tugas</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">HARI TANGGAL</label>
                            <input type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu" value="{{ old('waktu') }}" placeholder="Masukkan Hari dan Tanggal Penugasan...">

                            <!-- error message untuk nama -->
                            @error('waktu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">TEMPAT</label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{ old('tempat') }}" placeholder="Masukkan Tempat Penugasan...">

                            <!-- error message untuk merek -->
                            @error('tempat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">ANGGOTA</label>
                            <select name ="anggota" class="form-control">
                                <option value="">- Pilih Anggota -</option>
                                @foreach ($anggotas as $anggota)
                                    <option value="{{ $anggota->nama }}" {{ old('anggota') == $anggota->nama ? 'selected':null }}>{{ $anggota->nama }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk anggota -->
                            @error('anggota')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">JENIS</label>
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis" value="{{ old('jenis') }}" placeholder="Masukkan Jenis Tugas...">

                            <!-- error message untuk merek -->
                            @error('jenis')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">JUDUL</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Tugas...">

                            <!-- error message untuk merek -->
                            @error('judul')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">DESKRIPSI TUGAS</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Masukkan Deskripsi Tugas...">

                            <!-- error message untuk merek -->
                            @error('deskripsi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">BIDANG</label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" name="bidang" value="{{ old('bidang') }}" placeholder="Masukkan Bidang Tugas...">

                            <!-- error message untuk merek -->
                            @error('bidang')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">PENANGGUNG JAWAB</label>
                            <select name ="tanggungjawab" class="form-control">
                                <option value="">- Pilih Penanggung Jawab -</option>
                                @foreach ($anggotas as $tanggungjawab)
                                    <option value="{{ $tanggungjawab->nama }}" {{ old('anggota') == $tanggungjawab->nama ? 'selected':null }}>{{ $tanggungjawab->nama }}</option>
                                @endforeach
                            </select>
                            <!-- error message untuk penanggung jawab -->
                            @error('tanggungjawab')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="card border mb-3">

                        <label for="dokumen" class="form-label m-2"><b>DOKUMEN</b></label>
                        <div class="input-group mb-3">
                            <input type="file" name="dokumen" class="form-control m-2" id="inputGroupFile">
                            <label for="inputGroupFile" class="input-group-text m-2">Upload</label>
                        </div>
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
