@extends('layout.main')
@section('title', 'Tambah Penelaah')

@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Tambah Telaah</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Tambahkan Detail Telaah</span>
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('petas.tambahtugas', ['jenis' => $peta->jenis]) }}" method="POST" enctype="multipart/form-data">
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
                                <label class="font-weight-bold">ANGGOTA</label>
                                <select name ="anggota" class="form-control">
                                    <option value="">- Pilih Anggota -</option>
                                    @foreach ($users as $anggota)
                                        <option value="{{ $anggota->name }}"
                                            {{ old('anggota') == $anggota->name ? 'selected' : null }}>{{ $anggota->name }}
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
