@extends('layout.main')
@section('title', 'Detail Tugas Ketua')
@section('isi')

    <div class="col-md-16 p-5 pt-2">
        <h3><i class="fa fa-angle-double-right"></i>Detail Dokumen</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Detail Telaah</span>
        </h4>
        <div class="row">
            <div class="col-md-12">
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
                                <th class="col-2">Judul : </th>
                                <td>{{ $petas->judul }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Jenis : </th>
                                <td>
                                    <span class="badge badge-primary">{{ $petas->jenis }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-2">Auditee : </th>
                                <td>{{ $petas->nama }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Penelaah : </th>
                                <td>{{ $petas->anggota }}</td>
                            </tr>
                            <tr>
                                <th class="col-2">Dokumen : </th>
                                <td>
                                    @php
                                        $documents = [
                                            [
                                                'name' => $petas->dokumen,
                                                'path' => 'dokumenPR/',
                                                'label' => 'Dokumen Peta Risiko',
                                                'approval' => $petas->approvalPr,
                                                'approval_at' => $petas->approvalPr_at,
                                                'uploaded_at' => $petas->dokumen_at,
                                            ],
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
                                                            @if ($document['approval'] == 'approved')
                                                                {{ \Carbon\Carbon::parse($document['approval_at'])->format('d F Y') }}
                                                            @endif
                                                            @if (
                                                                (Auth::user()->id_level == 1 ||
                                                                    Auth::user()->id_level == 2 ||
                                                                    Auth::user()->id_level == 3 ||
                                                                    Auth::user()->id_level == 4 ||
                                                                    Auth::user()->id_level == 6) &&
                                                                    $document['approval'] != 'approved')
                                                                <form
                                                                    action="{{ route('petas.approve', ['id' => $petas->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success">Approve</button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ((Auth::user()->id_level == 1 || Auth::user()->id_level == 3) && $document['approval'] != 'approved')
                                                                <form
                                                                    action="{{ route('petas.disapprove', ['id' => $petas->id]) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Reject</button>
                                                                </form>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
