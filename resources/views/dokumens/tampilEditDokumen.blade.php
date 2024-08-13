@extends('layout.main')
@section('title','Edit Dokumen')

@section('isi')

<div class="col-md-16 p-4 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Edit Data Dokumen</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Tambahkan Detail Dokumen</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="/updateDataDokumen/{{ $dokumens->id }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">JUDUL</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ $dokumens->judul }}" placeholder="Masukkan Judul Dokumen...">

                            <!-- error message untuk nama -->
                            @error('judul')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">JENIS</label>
                            <select name ="jenis" class="form-control">
                                <option value="">- Pilih Jenis Dokumen -</option>
                                <option value="Peraturan">Reviu</option>
                                <option value="Template">Keuangan</option>
                            </select>

                            <!-- error message untuk merek -->
                            @error('jenis')
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
