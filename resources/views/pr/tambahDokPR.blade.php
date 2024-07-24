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
                                    name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Tugas...">

                                <!-- error message untuk judul -->
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JENIS</label>
                                <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                    name="jenis" value="{{ old('jenis') }}" placeholder="Masukkan Jenis Tugas...">

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
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
