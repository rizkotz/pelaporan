@extends('layout.main')
@section('title','Detail Tugas')
@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Detail Tugas</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Detail Penugasan</span>
    </h4>
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
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $posts->anggota }}</td>
                                            <td class="text-center"><a href="#" class="btn btn-sm btn-success">Aktif</a></td>
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
                                            <th scope="col">Nama Berkas</th>
                                            <th scope="col">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $posts->dokumen }}</td>
                                            <td>File Tugas</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                     </table>
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
