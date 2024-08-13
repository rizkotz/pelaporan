@extends('layout.main')
@section('title', 'Dokumen')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa-solid fa-file mr-2"></i>DOKUMEN</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">List</span>
            <span class="span1">Dokumen</span>
        </h4>
        <div class="row">

            <div class="col-md-5 mb-2">
                <form action="/dokumen/search" class="form=inline" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control float-right"
                            placeholder="Search: Masukkan Judul">
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
                                    <a href="{{ route('dokumens.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                                        DOKUMEN</a>
                                @endif
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Jenis</th>
                                    <th colspan="2" scope="col">Dokumen</th>
                                    <th scope="col">Waktu Pengumpulan</th>
                                    @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                        <th colspan="2" scope="col">Aksi</th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody>
                                @php $no = ($dokumens->currentPage() - 1) * $dokumens->perPage() + 1; @endphp
                                @forelse ($dokumens as $dokumen)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>
                                        <td class="text-center">
                                            {{ $dokumen->judul }}
                                        </td>
                                        <td class="text-center">
                                            {{ $dokumen->jenis }}
                                        </td>
                                        <td class="text">
                                            {{ $dokumen->dokumen }}
                                        </td>
                                        <td>
                                            <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                            <a href="{{ asset('dokumen_auditee/' . $dokumen->dokumen) }}" target="_blank"
                                                class="btn btn-info btn-sm" title="Buka Dokumen">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        {{-- <td>
                                            <!-- Menambahkan tombol download -->
                                            <a href="{{ route('download.dokumen', $dokumen->id) }}"
                                                class="btn btn-success btn-sm" title="Unduh Dokumen">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        </td> --}}
                                        <td class="text-center">
                                            {{ $dokumen->created_at->format('d F Y') }}
                                        </td>
                                        @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                            <td><a href="/tampilDataDokumen/{{ $dokumen->id }}"
                                                    class="btn fa-regular fa-pen-to-square bg-warning p-2 text-white"
                                                    data-toggle="tooltip" title="Edit Dokumen"></a> </td>
                                        @endif
                                        @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 5)
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('dokumens.destroy', $dokumen->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn fa-solid fa-trash bg-danger p-2 text-white"
                                                        data-toggle="tooltip" title="Hapus Dokumen"></button>
                                                </form>
                                            </td>
                                        @endif

                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Dokumen belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- PAGINATION (Hilangi -- nya)-->
                        {{ $dokumens->links('pagination::bootstrap-4') }}

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
