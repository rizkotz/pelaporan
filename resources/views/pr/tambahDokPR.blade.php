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
            {{-- bagian kiri --}}
            <div class="col-md-6">
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
                                @php
                                    $selectedUnit = old('jenis') ?? $unitKerjas->first()->nama_unit_kerja; // mengambil unit kerja yang dipilih atau default ke yang pertama
                                    $latestEntry = \App\Models\Peta::where('jenis', $selectedUnit)->latest()->first(); // Sesuaikan dengan model dan field yang digunakan

                                    if ($latestEntry) {
                                        $kodeParts = explode('_', $latestEntry->kode_regist);
                                        $lastNumber = isset($kodeParts[1]) ? intval($kodeParts[1]) : 0;
                                    } else {
                                        $lastNumber = 0;
                                    }

                                    $newKodeRegist = $selectedUnit . '_' . ($lastNumber + 1);
                                @endphp
                                <input type="text" class="form-control @error('kode_regist') is-invalid @enderror"
                                    name="kode_regist" value="{{ old('kode_regist', $newKodeRegist) }}"
                                    placeholder="Masukkan Kode..." readonly>

                                <!-- error message untuk judul -->
                                @error('kode_regist')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">IKU</label>
                                <input type="text" class="form-control @error('iku') is-invalid @enderror" name="iku"
                                    value="{{ old('iku') }}" placeholder="Masukkan IKU...">

                                <!-- error message untuk judul -->
                                @error('iku')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">SASARAN STRATEGIS</label>
                                <select class="form-control @error('sasaran') is-invalid @enderror"
                                    name="sasaran">
                                    <option value="" disabled selected>Pilih Sasaran</option>
                                    <option value="1. Meningkatnya kualitas lulusan pendidikan tinggi" {{ old('kategori') == 1 ? 'selected' : '' }}>1. Meningkatnya kualitas lulusan pendidikan tinggi</option>
                                    <option value="2. Meningkatnya kualitas dosen pendidikan tinggi" {{ old('kategori') == 2 ? 'selected' : '' }}>2. Meningkatnya kualitas dosen pendidikan tinggi</option>
                                    <option value="3. Meningkatnya kualitas kurikulum dan pembelajaran" {{ old('kategori') == 3 ? 'selected' : '' }}>3. Meningkatnya kualitas kurikulum dan pembelajaran</option>
                                    <option value="4. Meningkatnya tata kelola satuan kerja di lingkungan Ditjen Pendidikan Vokasi" {{ old('kategori') == 4 ? 'selected' : '' }}>4. Meningkatnya tata kelola satuan kerja di lingkungan Ditjen Pendidikan Vokasi</option>
                                </select>
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
                                <textarea class="form-control @error('pernyataan') is-invalid @enderror" name="pernyataan"
                                    placeholder="Masukkan Pernyataan Risiko..." rows="3">{{ old('pernyataan') }}</textarea>

                                <!-- error message untuk judul -->
                                @error('pernyataan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI RISIKO</label>
                                <select class="form-control @error('kategori') is-invalid @enderror"
                                    name="kategori">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="1. Risiko Strategis" {{ old('kategori') == 1 ? 'selected' : '' }}>1. Risiko Strategis</option>
                                    <option value="2. Risiko Operasional" {{ old('kategori') == 2 ? 'selected' : '' }}>2. Risiko Operasional</option>
                                    <option value="3. Risiko Keuangan" {{ old('kategori') == 3 ? 'selected' : '' }}>3. Risiko Keuangan</option>
                                    <option value="4. Risiko Kepatuhan" {{ old('kategori') == 4 ? 'selected' : '' }}>4. Risiko Kepatuhan</option>
                                    <option value="5. Risiko Kecurangan" {{ old('kategori') == 5 ? 'selected' : '' }}>5. Risiko Kecurangan</option>
                                </select>

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
                                <select class="form-control @error('metode') is-invalid @enderror"
                                    name="metode">
                                    <option value="" disabled selected>Pilih Metode</option>
                                    <option value="1" {{ old('metode') == 1 ? 'selected' : '' }}>1. Memberikan keyakinan yang memadai bagi tercapainya efektivitas dan efisiensi pencapaian tujuan penyelenggaraan pemerintahan negara</option>
                                    <option value="2" {{ old('metode') == 2 ? 'selected' : '' }}>2. Keandalan pelaporan keuangan</option>
                                    <option value="3" {{ old('metode') == 3 ? 'selected' : '' }}>3. Pengamanan aset negara</option>
                                    <option value="4" {{ old('metode') == 4 ? 'selected' : '' }}>4. Ketaatan terhadap peraturan perundang-undangan</option>
                                </select>

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
                                    <option value="1" {{ old('skor_kemungkinan') == 1 ? 'selected' : '' }}>1. Sangat Jarang</option>
                                    <option value="2" {{ old('skor_kemungkinan') == 2 ? 'selected' : '' }}>2. Jarang</option>
                                    <option value="3" {{ old('skor_kemungkinan') == 3 ? 'selected' : '' }}>3. Kadang-kadang</option>
                                    <option value="4" {{ old('skor_kemungkinan') == 4 ? 'selected' : '' }}>4. Sering</option>
                                    <option value="5" {{ old('skor_kemungkinan') == 5 ? 'selected' : '' }}>5. Sangat Sering</option>
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
                                    <option value="1" {{ old('skor_dampak') == 1 ? 'selected' : '' }}>1. Sangat Sedikit Berpengaruh</option>
                                    <option value="2" {{ old('skor_dampak') == 2 ? 'selected' : '' }}>2. Sedikit Berpengaruh</option>
                                    <option value="3" {{ old('skor_dampak') == 3 ? 'selected' : '' }}>3. Cukup Berpengaruh</option>
                                    <option value="4" {{ old('skor_dampak') == 4 ? 'selected' : '' }}>4. Berpengaruh</option>
                                    <option value="5" {{ old('skor_dampak') == 5 ? 'selected' : '' }}>5. Sangat Berpengaruh</option>
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

            {{-- bagian kanan --}}
            <div class="col-md-6">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h5>Data yang Telah Dimasukkan</h5>
                        <hr>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Judul:</strong> <span id="judulDisplay"></span></li>
                            <li class="list-group-item"><strong>Unit Kerja:</strong> <span id="unitKerjaDisplay"></span>
                            </li>
                            <li class="list-group-item"><strong>Kode Register:</strong> <span
                                    id="kodeRegistDisplay"></span></li>
                            <li class="list-group-item"><strong>IKU:</strong> <span id="ikuDisplay"></span></li>
                            <li class="list-group-item"><strong>Sasaran Strategis:</strong> <span
                                    id="sasaranDisplay"></span></li>
                            <li class="list-group-item"><strong>Program Kerja:</strong> <span id="prokerDisplay"></span>
                            </li>
                            <li class="list-group-item"><strong>Indikator:</strong> <span id="indikatorDisplay"></span>
                            </li>
                            <li class="list-group-item"><strong>Anggaran:</strong> <span id="anggaranDisplay"></span></li>
                            <li class="list-group-item"><strong>Pernyataan Risiko:</strong> <span
                                    id="pernyataanDisplay"></span></li>
                            <li class="list-group-item"><strong>Kategori Risiko:</strong> <span
                                    id="kategoriDisplay"></span></li>
                            <li class="list-group-item"><strong>Uraian Dampak:</strong> <span id="uraianDisplay"></span>
                            </li>
                            <li class="list-group-item"><strong>Metode Pencapaian:</strong> <span
                                    id="metodeDisplay"></span></li>
                            <li class="list-group-item"><strong>Skor Probabilitas:</strong> <span
                                    id="skor_kemungkinanDisplay"></span></li>
                            <li class="list-group-item"><strong>Skor Dampak:</strong> <span
                                    id="skor_dampakDisplay"></span></li>
                            <li class="list-group-item"><strong>Dokumen:</strong> <span id="dokumenDisplay"></span></li>
                        </ul>
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
                height: 38px;
                /* Adjust height to match other form controls */
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 30px;
                /* Align text vertically */
            }

            .select2-container .select2-selection--single .select2-selection__arrow {
                height: 36px;
                /* Adjust height of the dropdown arrow */
            }
        </style>
    @endpush

    @push('scripts')
        <!-- Jquery harus dimuat terlebih dahulu -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!-- Kemudian, Bootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            //UNIT KERJA
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: 'Pilih Unit Kerja',
                    allowClear: true
                });

                //Update tampilan data pada form change
                $('input, select, textarea').on('input change', function() {
                    let inputName = $(this).attr('name');
                    let displayId = `#${inputName}Display`;
                    $(displayId).text($(this).val());
                });
            });
        </script>
        {{-- <script>
            document.addEventListener('DOMContentLoaded', function() {
                const unitKerjaSelect = document.querySelector('select[name="jenis"]');
                const kodeRegistInput = document.querySelector('input[name="kode_regist"]');

                unitKerjaSelect.addEventListener('change', function() {
                    const unitKerja = this.value;

                    if (!unitKerja) {
                        kodeRegistInput.value = ''; // Kosongkan jika tidak ada unit kerja yang dipilih
                        return;
                    }

                    // Fetch the incremented number from the server
                    fetch(`/get-kode-register/${encodeURIComponent(unitKerja)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Combine unit kerja (X) and incremented number (Y)
                                const newCode = `${data.unitKerjaCode}_${data.nextNumber}`;
                                kodeRegistInput.value = newCode;
                            } else {
                                kodeRegistInput.value = ''; // Kosongkan jika ada error
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            kodeRegistInput.value = ''; // Kosongkan jika ada error
                        });
                });
            });
        </script> --}}
    @endpush

@endsection
