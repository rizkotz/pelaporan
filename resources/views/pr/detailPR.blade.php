@extends('layout.main')
@section('title', 'Detail Peta Risiko')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Detail Peta Risiko</h3>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="tittle-1">
                <span class="span0">Detail Peta</span>
            </h4>
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <table class="table table-white table-sm">
                            <tr>
                                <th class="col-2">Judul Kegiatan : </th>
                                <td>{{ $petas->judul }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Unit Kerja : </th>
                                <td>{{ $petas->jenis }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">PIC : </th>
                                <td>{{ $petas->nama }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">IKU : </th>
                                <td>{{ $petas->iku }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Kode Regist : </th>
                                <td>{{ $petas->kode_regist }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Identifikasi Risiko : </th>
                                <td>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th class="col-3">Sasaran Strategis:</th>
                                                <td>{{ $petas->sasaran }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Program Kerja:</th>
                                                <td>{{ $petas->proker }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Indikator:</th>
                                                <td>{{ $petas->indikator }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Anggaran:</th>
                                                <td>{{ $petas->anggaran }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Pernyataan Risiko:</th>
                                                <td>{{ $petas->pernyataan }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Kategori Risiko:</th>
                                                <td>{{ $petas->kategori }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Uraian Dampak:</th>
                                                <td>{{ $petas->uraian }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Metode Pencapaian:</th>
                                                <td>{{ $petas->metode }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Skor Probabilitas:</th>
                                                <td>{{ $petas->skor_kemungkinan }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Skor Dampak:</th>
                                                <td>{{ $petas->skor_dampak }}</td>
                                            </tr>
                                            <tr>
                                                <th class="col-3">Tingkat Risiko:</th>
                                                <td>Extreme</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
