@extends('layout.main')
@section('title', 'Tambah Tugas')

@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Tambah Tugas</h3>
        <hr>
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
                                <input type="text" class="form-control @error('waktu') is-invalid @enderror"
                                    id="waktu" name="waktu" value="{{ old('waktu') }}"
                                    placeholder="Masukkan Hari dan Tanggal Penugasan..." readonly>
                                @error('waktu')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TEMPAT</label>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                                    name="tempat" value="{{ old('tempat') }}" placeholder="Masukkan Tempat Penugasan...">
                                <!-- error message untuk tempat -->
                                @error('tempat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">PIC (PENANGGUNG JAWAB)</label>
                                <select name ="tanggungjawab" class="form-control" text="black">
                                    <option value="">- Pilih PIC -</option>
                                    @foreach ($users as $tanggungjawab)
                                        <option value="{{ $tanggungjawab->name }}"
                                            {{ old('anggota') == $tanggungjawab->name ? 'selected' : null }}>
                                            {{ $tanggungjawab->name }}</option>
                                    @endforeach
                                </select>
                                <!-- error message untuk penanggung jawab -->
                                @error('tanggungjawab')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">ANGGOTA</label>
                                <select name ="anggota" class="form-control">
                                    <option value="">- Pilih Anggota -</option>
                                    @foreach ($users as $anggota)
                                        <option value="{{ $anggota->name }}"
                                            {{ old('anggota') == $anggota->name ? 'selected' : null }}>
                                            {{ $anggota->name }}
                                        </option>
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
                                <select id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                    <option value="">- Pilih Jenis Tugas -</option>
                                    <option value="Reviu" {{ old('jenis') == 'Reviu' ? 'selected' : '' }}>Reviu</option>
                                    <option value="Monev" {{ old('jenis') == 'Monev' ? 'selected' : '' }}>Monev</option>
                                    <option value="Audit" {{ old('jenis') == 'Audit' ? 'selected' : '' }}>Audit</option>
                                </select>

                                <!-- error message untuk jenis -->
                                @error('jenis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Tugas...">

                                <!-- error message untuk judul -->
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">DESKRIPSI TUGAS</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    name="deskripsi" value="{{ old('deskripsi') }}"
                                    placeholder="Masukkan Deskripsi Tugas...">

                                <!-- error message untuk deskripsi -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">BIDANG</label>
                                <input type="text" id="bidang" class="form-control @error('bidang') is-invalid @enderror"
                                    name="bidang" value="{{ old('bidang') }}" placeholder="Masukkan Bidang Tugas..." readonly>

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
                                <label for="rubrik" class="form-label m-2"><b>KERTAS KERJA (RUBRIK
                                        PENILAIAN)</b></label>
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

    @push('styles')
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jenisSelect = document.getElementById('jenis');
                const bidangInput = document.getElementById('bidang');

                jenisSelect.addEventListener('change', function() {
                    // Ambil nilai yang dipilih dari dropdown jenis
                    const selectedJenis = jenisSelect.value;

                    // Set nilai bidang sesuai dengan jenis yang dipilih
                    bidangInput.value = selectedJenis;
                });
            });
        </script>
        <script>
            $(function() {
                $.datepicker.setDefaults($.datepicker.regional['id']);
                $("#waktu").datepicker({
                    dateFormat: "DD, d MM yy",
                    onSelect: function(dateText, inst) {
                        var date = $(this).datepicker('getDate');
                        var dayNames = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
                        var day = dayNames[date.getUTCDay()];
                        var formattedDate = day + ", " + $.datepicker.formatDate("d MM yy", date);
                        $(this).val(formattedDate);
                    }
                }).attr('readonly', 'readonly');
            });

            $.datepicker.regional['id'] = {
                closeText: 'Tutup',
                prevText: '←',
                nextText: '→',
                currentText: 'Hari ini',
                monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                dayNames: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                dayNamesShort: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                dayNamesMin: ['Mi', 'Se', 'Se', 'Ra', 'Ka', 'Ju', 'Sa'],
                weekHeader: 'Mg',
                dateFormat: 'dd/mm/yy',
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['id']);
        </script>
    @endpush

@endsection
