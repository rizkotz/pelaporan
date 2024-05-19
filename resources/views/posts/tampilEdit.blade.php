@extends('layout.main')
@section('title','Edit Tugas')
@section('isi')

<div class="col-md-16 p-5 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Edit Data Tugas</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Tambahkan Detail Tugas</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="/updateData/{{ $posts->id }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">WAKTU</label>
                            <input type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu" value="{{ $posts->waktu }}" placeholder="Masukkan Waktu Penugasan...">

                            <!-- error message untuk nama -->
                            @error('waktu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">TEMPAT</label>
                            <input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" value="{{  $posts->tempat }}" placeholder="Masukkan Tempat Penugasan...">

                            <!-- error message untuk merek -->
                            @error('tempat')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">JENIS</label>
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" name="jenis" value="{{  $posts->jenis }}" placeholder="Masukkan Jenis Tugas...">

                            <!-- error message untuk merek -->
                            @error('jenis')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">JUDUL</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{  $posts->judul }}" placeholder="Masukkan Judul Tugas...">

                            <!-- error message untuk merek -->
                            @error('judul')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">DESKRIPSI TUGAS</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{  $posts->deskripsi }}" placeholder="Masukkan Deskripsi Tugas...">

                            <!-- error message untuk merek -->
                            @error('deskripsi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">BIDANG</label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" name="bidang" value="{{  $posts->bidang }}" placeholder="Masukkan Bidang Tugas...">

                            <!-- error message untuk merek -->
                            @error('bidang')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card border mb-3">
                            <label for="dokumen" class="form-label m-2"><b>DOKUMEN REVIU</b></label>
                            <div class="input-group mb-3">
                                <input type="file" name="dokumen" class="form-control m-2" id="inputGroupFile">
                                <label for="inputGroupFile" class="input-group-text m-2">Upload</label>
                            </div>
                            <small class="form-text text-danger ml-4" style="font-style: italic;">
                                *dokumen harus berformat word / pdf
                            </small>
                            </div>

                            <div class="card border mb-3">
                            <label for="templateA" class="form-label m-2"><b>TEMPLATE BERITA ACARA</b></label>
                            <div class="input-group mb-3">
                                <input type="file" name="templateA" class="form-control m-2" id="inputGroupFile">
                                <label for="inputGroupFile" class="input-group-text m-2">Upload</label>
                            </div>
                            <small class="form-text text-danger ml-4" style="font-style: italic;">
                                *dokumen harus berformat word
                            </small>
                            </div>

                            <div class="card border mb-3">
                            <label for="templateB" class="form-label m-2"><b>TEMPLATE LEMBAR PENGESAHAN</b></label>
                            <div class="input-group mb-3">
                                <input type="file" name="templateB" class="form-control m-2" id="inputGroupFile">
                                <label for="inputGroupFile" class="input-group-text m-2">Upload</label>
                            </div>
                            <small class="form-text text-danger ml-4" style="font-style: italic;">
                                *dokumen harus berformat word
                            </small>
                            </div>

                            <div class="card border mb-3">
                            <label for="rubrik" class="form-label m-2"><b>KERTAS KERJA (RUBRIK PENILAIAN)</b></label>
                            <div class="input-group mb-3">
                                <input type="file" name="rubrik" class="form-control m-2" id="inputGroupFile">
                                <label for="inputGroupFile" class="input-group-text m-2">Upload</label>
                            </div>
                            <small class="form-text text-danger ml-4" style="font-style: italic;">
                                *dokumen harus berformat excel
                            </small>
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
