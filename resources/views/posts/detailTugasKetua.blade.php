@extends('layout.main')
@section('title','Detail Tugas Ketua')
@section('isi')

<div class="col-md-16 p-5 pt-2">
    <h3><i class="fa fa-angle-double-right"></i>Detail Tugas Ketua</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">Detail Penugasan</span>
    </h4>
    {{-- <div class=" mb-2 ">
        <a href="/detailTugas/print/{{ $posts->id }}" target="_blank" class="btn fa-solid fa-print bg-primary p-2 text-white" data-toggle="tooltip" title="PRINT"></a>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">

                    <table class="table table-white table-sm">
                        <tr>
                            <th class="col-2">Waktu : </th>
                            <td>
                                <i class="fa-regular fa-calendar-days mr-1" style="color: #0050db;"></i>
                                {{ $posts->waktu }}
                            </td>
                        </tr>
                        <tr>
                            <th class="col-2">Tempat : </th>
                            <td>
                                <i class="fa-regular fa-building mr-1" style="color: #0050db;"></i>
                                {{ $posts->tempat }}
                            </td>
                        </tr>
                        <tr>
                            <th class="col-2">PIC : </th>
                            <td>{{ $posts->tanggungjawab }}</td>
                        </tr>
                        <tr>
                            <th class="col-2">Anggota : </th>
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
                            <th class="col-2">Jenis : </th>
                            <td>
                                <a class="bg-primary p-1 rounded text-white">{{ $posts->jenis }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-2">Judul : </th>
                            <td>{{ $posts->judul }}</td>
                        </tr>
                        <tr>
                            <th class="col-2">Deskripsi Tugas : </th>
                            <td>{{ $posts->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="col-2">Bidang : </th>
                            <td>{{ $posts->bidang }}</td>
                        </tr>
                        <tr>
                            <th class="col-2">Dokumen : </th>
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
                            <th class="text-right bg-success p-1">Pengumpulan : </th>
                            <td class="text-right bg-success p-1"></td>
                        </tr>
                        <tr>
                            <th class="col-2">Dokumen Pengumpulan : </th>
                            <td>
                                @php
                                    $documents = [
                                        ['name' => $posts->hasilReviu, 'path' => 'hasil_reviu', 'label' => 'Dokumen Reviu', 'approval' => $posts->approvalReviu, 'type' => 'reviu'],
                                        ['name' => $posts->hasilBerita, 'path' => 'hasil_berita', 'label' => 'Berita Acara', 'approval' => $posts->approvalBerita, 'type' => 'berita'],
                                        ['name' => $posts->hasilPengesahan, 'path' => 'hasil_pengesahan', 'label' => 'Lembar Pengesahan', 'approval' => $posts->approvalPengesahan, 'type' => 'pengesahan'],
                                        ['name' => $posts->hasilRubrik, 'path' => 'hasil_rubrik', 'label' => 'Kertas Kerja', 'approval' => $posts->approvalRubrik, 'type' => 'rubrik'],
                                    ];

                                    $filteredDocuments = array_filter($documents, function ($document) {
                                        return !is_null($document['name']);
                                    });
                                @endphp

                                @if (count($filteredDocuments) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">No</th>
                                                <th colspan="2">Nama Berkas</th>
                                                <th scope="col">Keterangan</th>
                                                <th colspan="3" scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($filteredDocuments as $document)
                                                <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td>{{ $document['name'] }}</td>
                                                    <td>
                                                        <a href="{{ asset($document['path'].'/'.$document['name']) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $document['label'] }}</td>
                                                    <td>
                                                        @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $document['approval'] != 'approved')
                                                            <form action="{{ route('posts.approve', ['id' => $posts->id, 'type' => $document['type']]) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Approve</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $document['approval'] != 'approved')
                                                            <form action="{{ route('posts.disapprove', ['id' => $posts->id, 'type' => $document['type']]) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Reject</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p class="text-center bg-secondary p-1">==========Data belum tersedia==========</p>
                                @endif
                            </td>

                        </tr>


                        <th class="text-center bg-warning p-1">Perbaikan : </th>
                            <td class="text-right bg-warning p-1"></td>
                        <td>

                                <tr>
                                    <th class="col-2">Upload Perbaikan : </th>
                                    <td>

                                            Upload Perbaikan Reviu wajib berformat word (.doc / .docx)
                                                    <form action="/detailTugasKetua/{{ $posts->id }}/koreksi_ketua" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="file_type" value="koreksiReviu">
                                                        <div class="input-group mb-3">
                                                            <input type="file" name="koreksiReviu" class="form-control m-2" id="inputGroupFile">
                                                            <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                                        </div>
                                                    </form>

                                                    Upload Perbaikan Berita Acara wajib berformat word (.doc / .docx)
                                                    <form action="/detailTugasKetua/{{ $posts->id }}/koreksi_ketua" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="file_type" value="koreksiBerita">
                                                        <div class="input-group mb-3">
                                                            <input type="file" name="koreksiBerita" class="form-control m-2" id="inputGroupFile">
                                                            <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                                        </div>
                                                    </form>
                                                    Upload Perbaikan Lembar Pengesahan wajib berformat word (.doc / .docx)
                                                    <form action="/detailTugasKetua/{{ $posts->id }}/koreksi_ketua" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="file_type" value="koreksiPengesahan">
                                                        <div class="input-group mb-3">
                                                            <input type="file" name="koreksiPengesahan" class="form-control m-2" id="inputGroupFile">
                                                            <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                                        </div>
                                                    </form>
                                                    Upload Perbaikan Kertas Kerja wajib berformat excel (.xls / .xlsx)
                                                    <form action="/detailTugasKetua/{{ $posts->id }}/koreksi_ketua" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="file_type" value="koreksiRubrik">
                                                        <div class="input-group mb-3">
                                                            <input type="file" name="koreksiRubrik" class="form-control m-2" id="inputGroupFile">
                                                            <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                                        </div>
                                                    </form>

                                                @php
                                                    $files = [
                                                        ['name' => $posts->koreksiReviu, 'path' => 'koreksi_reviu', 'label' => 'Reviu'],
                                                        ['name' => $posts->koreksiBerita, 'path' => 'koreksi_berita', 'label' => 'Berita'],
                                                        ['name' => $posts->koreksiPengesahan, 'path' => 'koreksi_pengesahan', 'label' => 'Pengesahan'],
                                                        ['name' => $posts->koreksiRubrik, 'path' => 'koreksi_rubrik', 'label' => 'Rubrik'],
                                                    ];
                                                    $no = 1;
                                                @endphp
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">No</th>
                                                    <th colspan="2">Nama Berkas</th>
                                                    <th scope="col">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($files as $file)
                                                    @if ($file['name'])
                                                        <tr>
                                                            <td class="text-center">{{ $no++ }}</td>
                                                            <td>{{ $file['name'] }}</td>
                                                            <td>
                                                                <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                                <a href="{{ asset($file['path'].'/'.$file['name']) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <td>{{ $file['label'] }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </td>
                                </tr>
                        </td>
                        <th class="col-2">Komentar : </th>
                            <td>
                                @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3))
                                    <form action="{{ route('posts.comment.store', ['id' => $posts->id, 'type' => 'reviu']) }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-2">
                                        <textarea name="comment" rows="3" cols="50" placeholder="Masukkan komentar"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm mt-0">Kirim Komentar</button>
                                    </form>
                                @endif
                            </td>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
