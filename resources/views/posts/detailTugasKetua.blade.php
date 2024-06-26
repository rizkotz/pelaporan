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
                            <th class="text-right">Waktu : </th>
                            <td>
                                <i class="fa-regular fa-calendar-days mr-1" style="color: #0050db;"></i>
                                {{ $posts->waktu }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Tempat : </th>
                            <td>
                                <i class="fa-regular fa-building mr-1" style="color: #0050db;"></i>
                                {{ $posts->tempat }}
                            </td>
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
                            <th class="text-right">Jenis : </th>
                            <td>
                                <a class="bg-primary p-1 rounded text-white">{{ $posts->jenis }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Judul : </th>
                            <td>{{ $posts->judul }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Deskripsi Tugas : </th>
                            <td>{{ $posts->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Bidang : </th>
                            <td>{{ $posts->bidang }}</td>
                        </tr>
                        <tr>
                            <th class="text-right">Penanggung Jawab : </th>
                            <td>{{ $posts->tanggungjawab }}</td>
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
                            <th class="text-right">Dokumen Pengumpulan : </th>
                            <td>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th colspan="2">Nama Berkas</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $posts->hasilReviu }}</td>
                                            <td>
                                                <a href="{{ asset('hasil_reviu/'.$posts->hasilReviu) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>Dokumen Reviu</td>
                                            <td>
                                                @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $posts->approvalReviu != 'approved')
                                                <form action="{{ route('posts.approve', ['id' => $posts->id, 'type' => 'reviu']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('posts.disapprove', ['id' => $posts->id, 'type' => 'reviu']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>{{ $posts->hasilBerita }}</td>
                                            <td>
                                                <a href="{{ asset('hasil_berita/'.$posts->hasilBerita) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>Berita Acara</td>
                                            <td>
                                                @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $posts->approvalBerita != 'approved')
                                                <form action="{{ route('posts.approve', ['id' => $posts->id, 'type' => 'berita']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('posts.disapprove', ['id' => $posts->id, 'type' => 'berita']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>{{ $posts->hasilPengesahan }}</td>
                                            <td>
                                                <a href="{{ asset('hasil_pengesahan/'.$posts->hasilPengesahan) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>Lembar Pengesahan</td>
                                            <td>
                                                @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $posts->approvalPengesahan != 'approved')
                                                <form action="{{ route('posts.approve', ['id' => $posts->id, 'type' => 'pengesahan']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('posts.disapprove', ['id' => $posts->id, 'type' => 'pengesahan']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>{{ $posts->hasilRubrik }}</td>
                                            <td>
                                                <a href="{{ asset('hasil_rubrik/'.$posts->hasilRubrik) }}" target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>Kertas Kerja</td>
                                            <td>
                                                @if((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $posts->approvalRubrik != 'approved')
                                                <form action="{{ route('posts.approve', ['id' => $posts->id, 'type' => 'rubrik']) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </form>
                                                <form action="{{ route('posts.disapprove', ['id' => $posts->id, 'type' => 'rubrik']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>

                        </tr>
                        <th class="text-right">Komentar : </th>
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
