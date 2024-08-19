@extends('layout.main')
@section('title', 'Tambah Dokumen')

@section('isi')

    <div class="col-md-16 p-4 pt-2">
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

                            <div class="form-group">
                                <label class="font-weight-bold">KODE REGISTER</label>
                                <input type="text" class="form-control @error('kode_regist') is-invalid @enderror"
                                    name="kode_regist" value="{{ old('kode_regist') }}" placeholder="Masukkan Kode...">

                                <!-- error message untuk judul -->
                                @error('kode_regist')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">IKU</label>
                                <input type="text" class="form-control @error('iku') is-invalid @enderror"
                                    name="iku" value="{{ old('iku') }}" placeholder="Masukkan IKU...">

                                <!-- error message untuk judul -->
                                @error('iku')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">SASARAN STRATEGIS</label>
                                <input type="text" class="form-control @error('sasaran') is-invalid @enderror"
                                    name="sasaran" value="{{ old('sasaran') }}" placeholder="Masukkan Sasaran Strategis...">

                                <!-- error message untuk judul -->
                                @error('sasaran')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">PROGRAM KERJA</label>
                                <input type="text" class="form-control @error('proker') is-invalid @enderror"
                                    name="proker" value="{{ old('proker') }}" placeholder="Masukkan Program Kerja...">

                                <!-- error message untuk judul -->
                                @error('proker')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">INDIKATOR</label>
                                <input type="text" class="form-control @error('indikator') is-invalid @enderror"
                                    name="indikator" value="{{ old('indikator') }}" placeholder="Masukkan Indikator...">

                                <!-- error message untuk judul -->
                                @error('indikator')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">ANGGARAN</label>
                                <input type="text" class="form-control @error('anggaran') is-invalid @enderror"
                                    name="anggaran" value="{{ old('anggaran') }}" placeholder="Masukkan Anggaran...">

                                <!-- error message untuk judul -->
                                @error('anggaran')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">PERNYATAAN RISIKO</label>
                                <input type="text" class="form-control @error('pernyataan') is-invalid @enderror"
                                    name="pernyataan" value="{{ old('pernyataan') }}" placeholder="Masukkan Pernyataan Risiko...">

                                <!-- error message untuk judul -->
                                @error('pernyataan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI RISIKO</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                    name="kategori" value="{{ old('kategori') }}" placeholder="Masukkan Kategori...">

                                <!-- error message untuk judul -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">URAIAN DAMPAK</label>
                                <input type="text" class="form-control @error('uraian') is-invalid @enderror"
                                    name="uraian" value="{{ old('uraian') }}" placeholder="Masukkan Uraian...">

                                <!-- error message untuk judul -->
                                @error('uraian')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">METODE PENCAPAIAN</label>
                                <input type="text" class="form-control @error('metode') is-invalid @enderror"
                                    name="metode" value="{{ old('metode') }}" placeholder="Masukkan Metode Pencapaian Tujuan SPIP...">

                                <!-- error message untuk judul -->
                                @error('metode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">SKOR PROBABILITAS</label>
                                <select class="form-control @error('skor_kemungkinan') is-invalid @enderror"
                                name="skor_kemungkinan">
                                    <option value="" disabled selected>Pilih Skor</option>
                                    <option value="1" {{ old('skor_kemungkinan') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('skor_kemungkinan') == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('skor_kemungkinan') == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('skor_kemungkinan') == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('skor_kemungkinan') == 5 ? 'selected' : '' }}>5</option>
                                </select>

                                <!-- error message untuk judul -->
                                @error('skor_kemungkinan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">SKOR DAMPAK</label>
                                <select class="form-control @error('skor_dampak') is-invalid @enderror"
                                name="skor_dampak">
                                    <option value="" disabled selected>Pilih Skor</option>
                                    <option value="1" {{ old('skor_dampak') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('skor_dampak') == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('skor_dampak') == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('skor_dampak') == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('skor_dampak') == 5 ? 'selected' : '' }}>5</option>
                                </select>

                                <!-- error message untuk judul -->
                                @error('skor_dampak')
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
