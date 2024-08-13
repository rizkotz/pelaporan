@extends('layout.main')
@section('title', 'Detail Tugas')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Detail Tugas</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Detail Penugasan</span>
        </h4>
        {{-- <div class=" mb-2 ">
        <a href="/detailTugas/print/{id}" target="_blank" class="btn fa-solid fa-print bg-primary p-2 text-white" data-toggle="tooltip" title="PRINT"></a>
    </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <form action="/detailTugas/{{ $posts->id }}" method="GET" enctype="multipart/form-data">

                            @csrf
                            <table class="table table-white table-sm">
                                <tbody>
                                    <tr>
                                        <th class="col-2">Waktu :</th>
                                        <td><i class="fa-regular fa-calendar-days mr-1" style="color: #0050db;"></i>
                                            {{ $posts->waktu ? $posts->waktu : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th class="col-2">Tempat :</th>
                                        <td><i class="fa-regular fa-building mr-1"
                                                style="color: #0050db;"></i>{{ $posts->tempat }}</td>
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
                                        <td><span class="badge badge-primary">{{ $posts->jenis }}</span></td>
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
                                        <td><span class="badge badge-info">{{ $posts->bidang }}</span></td>
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
                                                            <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                            <a href="{{ asset('dokumenrev/' . $posts->dokumen) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
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
                                                            <a href="{{ asset('template_berita/' . $posts->templateA) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
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
                                                            <a href="{{ asset('template_pengesahan/' . $posts->templateB) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
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
                                                            <a href="{{ asset('template_rubrik/' . $posts->rubrik) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
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
                                        <th class="text-right"> </th>
                                        <td></td>
                                    </tr>
                        </form>

                        <div class="alert alert-warning">
                            <strong>Peringatan!</strong> Tenggat waktu tugas ini adalah 2 minggu sejak ditugaskan.
                        </div>

                        <tr>
                            <th class="text-left bg-success p-1 ">Pengumpulan : </th>
                            <td class="text-right bg-success p-1 "></td>
                        </tr>
                        <!-- Form POST untuk pengumpulan dokumen -->
                        <tr>
                            <th class="col-2">Dokumen Reviu : </th>
                            <td>
                                Upload Dokumen Reviu harus berformat word (.doc / .docx)
                                <form action="/detailTugas/{{ $posts->id }}/submit" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="file_type" value="hasilReviu">
                                    <div class="input-group mb-3">
                                        <input type="file" name="hasilReviu" class="form-control m-2"
                                            id="inputGroupFile">
                                        <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-2">Berita Acara : </th>
                            <td>
                                Upload Berita Acara harus berformat word (.doc / .docx)
                                <form action="/detailTugas/{{ $posts->id }}/submit" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="file_type" value="hasilBerita">
                                    <div class="input-group mb-3">
                                        <input type="file" name="hasilBerita" class="form-control m-2"
                                            id="inputGroupFile">
                                        <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-2">Lembar Pengesahan : </th>
                            <td>
                                Upload Lembar Pengesahan harus berformat word (.doc / .docx)
                                <form action="/detailTugas/{{ $posts->id }}/submit" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="file_type" value="hasilPengesahan">
                                    <div class="input-group mb-3">
                                        <input type="file" name="hasilPengesahan" class="form-control m-2"
                                            id="inputGroupFile">
                                        <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th class="col-2">Kertas Kerja : </th>
                            <td>
                                Upload Kertas Kerja harus berformat excel (.xls / .xlsx)
                                <form action="/detailTugas/{{ $posts->id }}/submit" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="file_type" value="hasilRubrik">
                                    <div class="input-group mb-3">
                                        <input type="file" name="hasilRubrik" class="form-control m-2"
                                            id="inputGroupFile">
                                        <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                    </div>
                                </form>
                                {{-- <button type="submit" class="ml-2 mb-2 btn btn-md btn-primary">SIMPAN</button> --}}
                            </td>
                        </tr>

                        <tr>
                            <th class="col-2">Dokumen Pengumpulan : </th>
                            <td>
                                @php
                                    $files = [
                                        [
                                            'name' => $posts->hasilReviu,
                                            'path' => 'hasil_reviu/',
                                            'label' => 'Dokumen Reviu',
                                            'approval' => $posts->approvalReviu,
                                            'approval_at' => $posts->approvalReviu_at,
                                            'uploaded_at' => $posts->hasilReviu_uploaded_at,
                                        ],
                                        [
                                            'name' => $posts->hasilBerita,
                                            'path' => 'hasil_berita/',
                                            'label' => 'Berita Acara',
                                            'approval' => $posts->approvalBerita,
                                            'approval_at' => $posts->approvalBerita_at,
                                            'uploaded_at' => $posts->hasilBerita_uploaded_at,
                                        ],
                                        [
                                            'name' => $posts->hasilPengesahan,
                                            'path' => 'hasil_pengesahan/',
                                            'label' => 'Lembar Pengesahan',
                                            'approval' => $posts->approvalPengesahan,
                                            'approval_at' => $posts->approvalPengesahan_at,
                                            'uploaded_at' => $posts->hasilPengesahan_uploaded_at,
                                        ],
                                        [
                                            'name' => $posts->hasilRubrik,
                                            'path' => 'hasil_rubrik/',
                                            'label' => 'Kertas Kerja',
                                            'approval' => $posts->approvalRubrik,
                                            'approval_at' => $posts->approvalRubrik_at,
                                            'uploaded_at' => $posts->hasilRubrik_uploaded_at,
                                        ],
                                    ];

                                    $filteredFiles = array_filter($files, function ($file) {
                                        return !is_null($file['name']);
                                    });
                                @endphp

                                @if (count($filteredFiles) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">No</th>
                                                <th colspan="2">Nama Berkas</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Waktu Pengumpulan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($filteredFiles as $file)
                                                <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td>{{ $file['name'] }}</td>
                                                    <td>
                                                        <a href="{{ asset($file['path'] . '/' . $file['name']) }}"
                                                            target="_blank" class="btn btn-info btn-sm"
                                                            title="Buka Dokumen">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>{{ $file['label'] }}</td>
                                                    <td>
                                                        @if ($file['approval'] == 'approved')
                                                            <span class="badge badge-success">Disetujui</span>
                                                            <div>
                                                                <small>{{ \Carbon\Carbon::parse($file['approval_at'])->format('d F Y') }}</small>
                                                            </div>
                                                        @elseif($file['approval'] == 'rejected')
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{ \Carbon\Carbon::parse($file['uploaded_at'])->format('d F Y') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-danger">
                                        Data belum Tersedia.
                                    </div>
                                    {{-- <p class="text-center bg-secondary p-1">==========Data belum tersedia==========</p> --}}
                                @endif
                                @php
                                    $files = [
                                        [
                                            'name' => $posts->koreksiReviu,
                                            'path' => 'koreksi_reviu/',
                                            'label' => 'Dokumen Reviu',
                                        ],
                                        [
                                            'name' => $posts->koreksiBerita,
                                            'path' => 'koreksi_berita/',
                                            'label' => 'Berita Acara',
                                        ],
                                        [
                                            'name' => $posts->koreksiPengesahan,
                                            'path' => 'koreksi_pengesahan/',
                                            'label' => 'Lembar Pengesahan',
                                        ],
                                        [
                                            'name' => $posts->koreksiRubrik,
                                            'path' => 'koreksi_rubrik/',
                                            'label' => 'Kertas Kerja',
                                        ],
                                    ];
                                    $no = 1;
                                    $filteredFiles = array_filter($files, function ($file) {
                                        return !is_null($file['name']);
                                    });
                                @endphp
                                @if (count($filteredFiles) > 0)
                                    Perbaikan dari Ketua :
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
                                                            <a href="{{ asset($file['path'] . '/' . $file['name']) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td>{{ $file['label'] }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if (
                                    $posts->approvalReviu == 'approved' &&
                                        $posts->approvalBerita == 'approved' &&
                                        $posts->approvalPengesahan == 'approved' &&
                                        $posts->approvalRubrik == 'approved')
                                    @if (Auth::user()->id_level == 1 || Auth::user()->name == $posts->tanggungjawab)
                        <tr>
                            <th class="col-2">Print Dokumen : </th>
                            <td>
                                <a href="{{ route('printDetailTugas', ['id' => $posts->id]) }}" target="_blank"
                                    class="btn fa-solid fa-print bg-primary ml-2 p-2 text-white" data-toggle="tooltip"
                                    title="PRINT"></a>
                            </td>
                            @endif
                            @endif
                            </td>
                        </tr>
                        <form action="/detailTugas/{{ $posts->id }}/submit_akhir" method="POST"
                            enctype="multipart/form-data"
                            onsubmit="return confirm('Dokumen wajib sudah diTTD dan stempel');">
                            @csrf
                            <tr>
                                <th class="col-2">Upload Laporan <p>Akhir : </th>
                                <td>
                                    @if (
                                        $posts->approvalReviu == 'approved' &&
                                            $posts->approvalBerita == 'approved' &&
                                            $posts->approvalPengesahan == 'approved' &&
                                            $posts->approvalRubrik == 'approved')
                                        Upload Laporan Akhir harus berformat pdf (.pdf)
                                        <div class="input-group mb-3">
                                            <input type="file" name="laporan_akhir" class="form-control m-2"
                                                id="inputGroupFile">
                                            <button type ="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                        </div>
                                        @if (!empty($posts->laporan_akhir))
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
                                                        <td>{{ $posts->laporan_akhir }}</td>
                                                        <td>
                                                            <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                                            <a href="{{ asset('hasil_akhir/' . $posts->laporan_akhir) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>

                                                        <td>Laporan Akhir</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    @else
                                        <div class="alert alert-danger">
                                            Dokumen belum diaprove oleh ketua.
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </form>
                        <tr>
                            <th class="col-2">Komentar Ketua : </th>
                            <td>
                                <ul>
                                    @foreach ($comments as $comment)
                                        @if ($comment->type === 'reviu')
                                            <li>{{ $comment->comment }}</li>
                                            <!-- Tambahkan informasi tambahan seperti waktu komentar atau penulis jika perlu -->
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
    document.getElementById('uploadLaporanAkhirForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (confirm("Dokumen wajib sudah distempel. Apakah Anda yakin ingin mengunggah?")) {
            this.submit();
        }
    });
</script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

@endsection
