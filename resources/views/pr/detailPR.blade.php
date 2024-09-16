@extends('layout.main')
@section('title', 'Detail Peta Risiko')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Detail Dokumen</h3>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="tittle-1">
                <span class="span0">Detail Telaah</span>
            </h4>
            <!-- Tombol untuk membuka modal popup -->
            @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                Tambah Dokumen
            </button>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <table class="table table-white table-sm">
                            <tr>
                                <th class="col-2">Waktu : </th>
                                <td>
                                    <i class="fa-regular fa-calendar-days mr-1" style="color: #0050db;"></i>
                                    {{ $petas->waktu }}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-2">Penelaah : </th>
                                <td>{{ $petas->anggota }}</td>
                            </tr>
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

                            @if ($petas->dokumen)

                                @if (Auth::user()->id_level == 1 ||
                                        Auth::user()->id_level == 2 ||
                                        Auth::user()->id_level == 3 ||
                                        Auth::user()->id_level == 4 ||
                                        Auth::user()->id_level == 6)
                                    @php
                                        $documents = [
                                            [
                                                'name' => $petas->dokumen,
                                                'path' => 'dokumenPR/',
                                                'label' => 'Dokumen Peta Risiko',
                                                'approval' => $petas->approvalPr,
                                                'uploaded_at' => $petas->dokumen_at,
                                                'approval_at' => $petas->approvalPr_at,
                                            ],
                                        ];

                                        $filteredDocuments = array_filter($documents, function ($document) {
                                            return !is_null($document['name']);
                                        });
                                    @endphp

                                    @if (count($filteredDocuments) > 0)
                                        <tr>
                                            <th class="col-2">Dokumen : </th>
                                            <td>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th scope="col">No</th>
                                                            <th colspan="2">Nama Berkas</th>
                                                            <th scope="col">Keterangan</th>
                                                            <th scope="col">Waktu Pengumpulan</th>
                                                            <th colspan="3" scope="col">Approving</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1; @endphp
                                                        @foreach ($filteredDocuments as $document)
                                                            <tr>
                                                                <td class="text-center">{{ $no++ }}</td>
                                                                <td>{{ $document['name'] }}</td>
                                                                <td>
                                                                    <a href="{{ asset($document['path'] . '/' . $document['name']) }}"
                                                                        target="_blank" class="btn btn-info btn-sm"
                                                                        title="Buka Dokumen">
                                                                        <i class="fa-solid fa-eye"></i>
                                                                    </a>
                                                                </td>
                                                                <td>{{ $document['label'] }}</td>
                                                                <td class="text-center">
                                                                    {{ \Carbon\Carbon::parse($document['uploaded_at'])->format('d F Y') }}
                                                                </td>
                                                                <td>

                                                                    @if (Auth::user()->id_level == 1 ||
                                                                            Auth::user()->id_level == 2 ||
                                                                            Auth::user()->id_level == 3 ||
                                                                            Auth::user()->id_level == 4 ||
                                                                            Auth::user()->id_level == 6)
                                                                        <form
                                                                            action="{{ route('petas.approve', ['id' => $petas->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-success">Approve</button>
                                                                        </form>
                                                                        @if ($document['approval'] == 'approved')
                                                                            <p> {{ \Carbon\Carbon::parse($document['approval_at'])->format('d F Y') }}
                                                                            </p>
                                                                        @endif

                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('petas.disapprove', ['id' => $petas->id]) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Reject</button>
                                                                    </form>
                                                                    @if ($document['approval'] == 'rejected')
                                                                        <p> {{ \Carbon\Carbon::parse($document['approval_at'])->format('d F Y') }}
                                                                        </p>
                                                                    @endif
                                                                </td>
                                                        @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                        </table>
                        </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="2">
                                <div class="alert alert-danger">
                                    Dokumen belum disubmit oleh Auditee.
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endif
                        {{-- Dokumen Auditee hanya untuk id_level 5 --}}
                        @if (Auth::user()->id_level == 1 || Auth::user()->id_level == 5)
                            <tr>
                                <th class="col-2">Upload Ulang : </th>
                                <td>
                                    Upload dokumen harus berformat excel (.xls / .xlsx)
                                    <form action="/updateData/{{ $petas->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="file_type" value="hasilRubrik">
                                        <div class="input-group mb-3">
                                            <input type="file" name="dokumen" class="form-control m-2"
                                                id="inputGroupFile">
                                            <button type="submit" class=" m-2 btn btn-md btn-primary">Upload</button>
                                        </div>
                                    </form>
                                    {{-- <button type="submit" class="ml-2 mb-2 btn btn-md btn-primary">SIMPAN</button> --}}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-2">Dokumen PIC : </th>
                                <td>
                                    @php
                                        $documents = [
                                            [
                                                'name' => $petas->dokumen,
                                                'path' => 'dokumenPR/',
                                                'label' => 'Dokumen Peta Risiko',
                                                'uploaded_at' => $petas->dokumen_at,
                                            ],
                                        ];

                                        $filteredDocuments = array_filter($documents, function ($document) {
                                            return !is_null($document['name']);
                                        });
                                    @endphp
                                    @php
                                        $documentHistories = $petas->documentHistories;
                                    @endphp

                                    @if ($documentHistories->count() > 0)
                                        <h5>Riwayat Dokumen</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">No</th>
                                                    <th colspan="2">Nama Berkas</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Waktu Pengumpulan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($documentHistories as $history)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $history->dokumen }}</td>
                                                        <td>
                                                            <a href="{{ asset('dokumenPR/' . $history->dokumen) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($history->status == 'approved')
                                                                <span class="badge badge-success">Disetujui</span>
                                                            @elseif($history->status == 'rejected')
                                                                <span class="badge badge-danger">Ditolak</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            {{ \Carbon\Carbon::parse($history->uploaded_at)->format('d F Y') }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    @if (count($filteredDocuments) > 0)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">No</th>
                                                    <th colspan="2">Nama Berkas</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Waktu Pengumpulan</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach ($filteredDocuments as $document)
                                                    <tr>
                                                        <td class="text-center">{{ $no++ }}</td>
                                                        <td>{{ $document['name'] }}</td>
                                                        <td>
                                                            <a href="{{ asset($document['path'] . '/' . $document['name']) }}"
                                                                target="_blank" class="btn btn-info btn-sm"
                                                                title="Buka Dokumen">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td>{{ $document['label'] }}</td>
                                                        <td class="text-center">
                                                            {{ \Carbon\Carbon::parse($document['uploaded_at'])->format('d F Y') }}
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($petas->approvalPr == 'approved')
                                                                <span class="badge badge-success">Disetujui</span>
                                                                <div>
                                                                    <small>{{ \Carbon\Carbon::parse($petas->approvalPr_at)->format('d F Y') }}</small>
                                                                </div>
                                                            @elseif($petas->approvalPr == 'rejected')
                                                                <span class="badge badge-danger">Ditolak</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-danger">
                                            Dokumen belum disubmit oleh Auditee.
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endif
                        <!-- Form Komentar -->
                        @if (Auth::user()->id_level == 1 ||
                                Auth::user()->id_level == 2 ||
                                Auth::user()->id_level == 3 ||
                                Auth::user()->id_level == 4 ||
                                Auth::user()->id_level == 6)
                            <tr>
                                <th class="col-2">Komentar : </th>
                                <td>
                                    <div class="card mt-4">
                                        <div class="card-header">Tambah Komentar</div>
                                        <div class="card-body">
                                            <form action="{{ route('postComment', $petas->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="comment" class="form-control" rows="3" placeholder="Masukkan komentar" required></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @if ($comment_prs->isNotEmpty())
                            <tr>
                                <th class="col-2">Daftar Komentar</th>
                                <td>
                                    <!-- Daftar Komentar -->
                                    <div class="card mt-4">
                                        <div class="card-header">Komentar</div>
                                        <div class="card-body">
                                            @forelse($comment_prs as $comment)
                                                <div class="media mb-3">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                                        <p>{{ $comment->comment }}</p>
                                                        <small>{{ $comment->created_at->format('d M Y') }}</small>
                                                    </div>
                                                </div>
                                                <hr>
                                            @empty
                                                <p>Belum ada komentar.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @else
                        <div class="alert alert-info">
                            Belum ada dokumen yang diunggah. Harap unggah dokumen terlebih dahulu.
                        </div>
                        @endif
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Popup -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Tambah Dokumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('uploadDokumen', $petas->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="dokumen">Pilih Dokumen:</label>
                                <input type="file" name="dokumen" class="form-control" id="dokumen" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
