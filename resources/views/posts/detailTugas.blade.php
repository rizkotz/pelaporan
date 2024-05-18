@extends('layout.main')
@section('title','Detail Tugas')
@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Detail Tugas</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Detail Penugasan</span>
    </h4>
    <div class=" mb-2 ">
        <a href="/detailTugas/print/{id}" target="_blank" class="btn fa-solid fa-print bg-primary p-2 text-white" data-toggle="tooltip" title="PRINT"></a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">

                    <form action="/detailTugas/{{ $posts->id }}" method="GET" enctype="multipart/form-data">

                     @csrf
                     <table class="table table-white table-sm">
                        <tr>
                            <th class="text-right">Waktu : </th><td><i class="fa-regular fa-calendar-days mr-1" style="color: #0050db;"></i>
                                {{ ($posts->waktu)? $posts->waktu : '' }}</td>
                        </tr>

                        <tr>
                            <th class="text-right">Tempat : </th><td><i class="fa-regular fa-building mr-1" style="color: #0050db;"></i>{{ $posts->tempat }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Anggota : </th>
                            <td>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Anggota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $posts->anggota }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Jenis : </th><td><a class="bg-primary p-1 rounded text-white">{{$posts->jenis }}</a></td>
                        </tr>
                        <tr>
                            <th class="text-right">Judul : </th><td>{{ $posts->judul }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Deskripsi Tugas : </th><td>{{ $posts->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Bidang : </th><td>{{ $posts->bidang }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Penanggung Jawab : </th><td>{{ $posts->tanggungjawab }}</td>
                        </tr>

                        <tr>
                            <th class="text-right">Dokumen : </th>
                            <td>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th colspan="2">Nama Berkas</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $posts->dokumen }}</td>
                                            <td>
                                                <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                <a href="{{ asset('dokumenrev/'.$posts->dokumen) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>

                                            <td>Dokumen Reviu</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>{{ $posts->templateA }}</td>
                                            <td>
                                                <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                <a href="{{ asset('template_berita/'.$posts->templateA) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>

                                            <td>Template</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>{{ $posts->templateB }}</td>
                                            <td>
                                                <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                <a href="{{ asset('template_pengesahan/'.$posts->templateB) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>

                                            <td>Template</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>{{ $posts->rubrik }}</td>
                                            <td>
                                                <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                <a href="{{ asset('template_rubrik/'.$posts->rubrik) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>

                                            <td>Kertas Kerja</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right"> </th><td></td>
                        </tr>
                    </form>
                        <tr>
                            <th class="text-right bg-success p-1 ">Pengumpulan : </th><td class="text-right bg-success p-1 "></td>
                        </tr>

                            <tr>
                                <th class="text-right">Dokumen : </th>
                                <td>
                                Upload Dokumen harus berformat word (.doc / .docx)
                                <div class="input-group mb-3">
                                    <input type="file" name="dokumen" class="form-control m-2" id="inputGroupFile">
                                    <label for="inputGroupFile" class="input-group-text m-2">Upload</label>
                                </div>
                                <button type="submit" class="ml-2 mb-2 btn btn-md btn-primary">SIMPAN</button>

                                </td>
                            </tr>



                            <tr>
                                <th class="text-right">Dokumen Pengumpulan : </th>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">No</th>
                                                <th colspan="2">Nama Berkas</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>{{ $posts->pengumpulan }}</td>
                                                <td>
                                                    <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                    <a href="{{ asset('pengumpulan/'.$posts->pengumpulan) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                </td>

                                                <td>File Tugas</td>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

@endsection
