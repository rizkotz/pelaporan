@extends('layout.main')
@section('title', 'Peta Risiko')
@section('isi')

    <div class="col-md-16 p-5 pt-2">
        <h3><i class="fa-solid fa-list-check mr-2"></i>Peta Risiko</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">List</span>
            <span class="span1">Dokumen</span>
        </h4>
        <div class="row">
            <div class="col-md-6 mb-2">
                <form action="/petaRisiko/search" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control float-right"
                            placeholder="Search: Masukkan Judul/ Waktu/ PIC/ Anggota">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                    <a href="{{ route('petas.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                        DOKUMEN</a>
                                @endif
                            </div>
                        </div>
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Dokumen</th>
                                    <th scope="col">Status</th>
                                    <th colspan="4" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($petas as $peta)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $peta->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $peta->judul }}
                                        </td>
                                        <td class="text-center">
                                            {{ $peta->jenis }}
                                        </td>
                                        <td class="text">
                                            {{ $peta->dokumen }}
                                            <div>
                                                <small>
                                                    <span class="badge badge-secondary">
                                                        {{ \Carbon\Carbon::parse($peta->dokumen_at)->format('d F Y') }}
                                                    </span>
                                                </small>
                                            </div>
                                        </td>
                                        <td class="text">
                                            @if ($peta->approvalPr == 'approved')
                                                <span class="badge badge-success">Disetujui</span>
                                                <div>
                                                    <small>{{ \Carbon\Carbon::parse($peta->approvalPr_at)->format('d F Y') }}</small>
                                                </div>
                                            @elseif($peta->approvalPr == 'rejected')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        @if (auth()->user()->id_level == 1 ||
                                                auth()->user()->id_level == 2 ||
                                                auth()->user()->id_level == 3 ||
                                                auth()->user()->id_level == 4 ||
                                                auth()->user()->id_level == 6)
                                            <td><a href="{{ route('detailPR', ['id' => $peta->id]) }}"
                                                    class="btn fa-solid fa-list bg-success p-2 text-white"
                                                    data-toggle="tooltip" title="Detail Dokumen"></a> </td>
                                        @endif
                                        @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                            <td><a href="/tampilData/{{ $peta->id }}"
                                                    class="btn fa-regular fa-pen-to-square bg-warning p-2 text-white"
                                                    data-toggle="tooltip" title="Edit Dokumen"></a> </td>
                                        @endif
                                        @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2)
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('petas.destroy', $peta->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- <button type="submit" class="fa-solid fa-trash bg-danger p-2 text white"></button> -->
                                                    <button type="submit"
                                                        class="btn fa-solid fa-trash bg-danger p-2 text-white"
                                                        data-toggle="tooltip" title="Hapus Dokumen"></button>
                                                </form>
                                            </td>
                                        @endif
                                        @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2)
                                            <td><a href="{{ route('petas.tugas', ['id' => $peta->id]) }}"
                                                    class="btn fa-solid fa-plus bg-purple p-2 text-white"
                                                    data-toggle="tooltip" title="Tambah Anggota"></a> </td>
                                        @endif
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Peta Risiko belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- PAGINATION -->
                        {{ $petas->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>

@endsection
