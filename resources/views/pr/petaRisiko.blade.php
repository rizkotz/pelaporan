@extends('layout.main')
@section('title', 'Peta Risiko')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa-regular fa-newspaper mr-2"></i>Peta Risiko</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">List</span>
            <span class="span1">Dokumen</span>
        </h4>
        <!-- Rekapitulasi -->
        <div class="row mb-1">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <strong>Rekapitulasi:</strong>
                    <ul>
                        <li>Jumlah Dokumen <span class="badge badge-success">Disetujui</span> : {{ $approvedCount }}</li>
                        <li>Jumlah Dokumen <span class="badge badge-danger">Ditolak</span> : {{ $rejectedCount }}</li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- search bar --}}
        <div class="row">
            <div class="col-md-6 mb-2">
                <form action="/petaRisiko/search" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control float-right"
                            placeholder="Search: Masukkan Judul/ Waktu/ PIC/">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        <!-- Filter Jenis -->
        @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2 || auth()->user()->id_level == 3 || auth()->user()->id_level == 4 || auth()->user()->id_level == 6)
        <div class="row mb-3">
            <div class="col-md-12">
                <form action="{{ route('petas.index') }}" method="GET">
                    <div class="input-group">
                        <select name="jenis" class="form-control">
                            <option value="">-- Pilih Jenis --</option>
                            @foreach ($unitKerjas as $unitKerja)
                                <option value="{{ $unitKerja->nama_unit_kerja }}"
                                    {{ request('jenis') == $unitKerja->nama_unit_kerja ? 'selected' : '' }}>
                                    {{ $unitKerja->nama_unit_kerja }}
                                </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                    <a href="{{ route('petas.create') }}" class="btn btn-md btn-success mb-1">TAMBAH
                                        PETA</a>
                                @endif
                                <a href="{{ route('petas.tabel') }}" class="btn btn-md btn-primary mb-1">Tabel
                                    Matrik</a>
                            </div>
                        </div>
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">PIC</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Unit Kerja</th>
                                    <th scope="col">IKU</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Status</th>
                                    <th colspan="4" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = ($petas->currentPage() - 1) * $petas->perPage() + 1; @endphp
                                @forelse ($petas as $peta)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
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
                                        <td class="text-center">
                                            {{ $peta->iku }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-black">
                                            {{ $peta->kode_regist }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if ($peta->dokumen)
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
                                            @else
                                                <span class="badge badge-secondary">Kosong</span>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('detailPR', ['id' => $peta->id]) }}"
                                                class="btn fa-solid fa-list bg-success p-2 text-white" data-toggle="tooltip"
                                                title="Detail Dokumen"></a> </td>
                                        {{-- @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                            <td><a href="/tampilData/{{ $peta->id }}"
                                                    class="btn fa-regular fa-pen-to-square bg-warning p-2 text-white"
                                                    data-toggle="tooltip" title="Edit Dokumen"></a> </td>
                                        @endif --}}
                                        <td>
                                            <a href="{{ route('petas.tabelUnitKerja', ['unitKerja' => $peta->jenis]) }}"
                                               class="btn fa-solid fa-table bg-info p-2 text-white"
                                               data-toggle="tooltip" title="Lihat Tabel Matrik Unit Kerja"></a>
                                        </td>
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
