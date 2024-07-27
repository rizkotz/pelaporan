@extends('layout.main')
@section('title', 'Tambah Dokumen')

@section('isi')

    <div class="col-md-16 p-5 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Tambah Dokumen</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Tambahkan Detail Dokumen</span>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('petas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Dokumen...">

                                <!-- error message untuk judul -->
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">UNIT KERJA</label>
                                <select name="jenis" class="form-control select2 @error('jenis') is-invalid @enderror">
                                    @foreach ($unitKerjas as $unit)
                                        <option value="{{ $unit->nama_unit_kerja }}">{{ $unit->nama_unit_kerja }}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk jenis -->
                                @error('jenis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="card border mb-3">
                                <label for="dokumen" class="form-label m-2"><b>DOKUMEN PETA RISIKO</b></label>
                                <div class="input-group mb-3">
                                    <input type="file" name="dokumen" class="form-control m-2" id="inputGroupFile">
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

    @push('styles')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container .select2-selection--single {
                height: 38px; /* Adjust height to match other form controls */
            }
            .select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 30px; /* Align text vertically */
            }
            .select2-container .select2-selection--single .select2-selection__arrow {
                height: 36px; /* Adjust height of the dropdown arrow */
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: 'Pilih Unit Kerja',
                    allowClear: true
                });
            });
        </script>
    @endpush

@endsection
