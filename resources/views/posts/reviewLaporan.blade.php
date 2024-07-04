@extends('layout.main')
@section('title','Review Laporan')
@section('isi')

<div class="col-md-16 p-5 pt-2">
    <h3><i class="fa-solid fa-list-check mr-2"></i>PIC Kegiatan</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">List</span>
        <span class="span1">Tugas</span>
    </h4>
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ route('posts.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="tanggungjawab" class="form-control" placeholder="Tanggung Jawab" value="{{ request('tanggungjawab') }}">
                    <input type="text" name="anggota" class="form-control" placeholder="Anggota" value="{{ request('anggota') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i> Filter
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
                        <div class="col-md-6 mb-3">
                            @if (auth()->user()->id_level == 1 || auth()->user()->id_level ==2)
                            <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH TUGAS</a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <form action="/reviewLaporan/search"  method="GET">
                                <div class="input-group">
                                <input type="search" name="search" class="form-control float-right" placeholder="Search: Masukkan Judul">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6 mb-2 ml-3">
                                <a href="/reviewLaporan/print" target="_blank" class="btn btn-md btn-primary mb-3">Print</a>
                            </div>
                            <div class="col-md-6 mb-2 ml-3">
                                <a href="/reviewLaporan/printpdf" target="_blank" class="btn btn-md btn-danger mb-3">Print PDF</a>
                            </div>
                        </div> --}}




                    <table class="table table-bordered mt-2">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">Waktu</th>
                            <th scope="col">Tempat</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Anggota</th>
                            <th colspan="4" scope="col" >Aksi</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($posts as $post)
                            <tr>

                                <td class="text-center">
                                    {{ $post->waktu }}
                                </td>
                                <td class="text-center">
                                    {{ $post->tempat }}
                                </td>
                                <td class="text-center">
                                    {{ $post->jenis }}
                                </td>
                                <td class="text">
                                    {{ $post->judul }}
                                </td>
                                <td class="text">
                                    {{ $post->deskripsi }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-primary">
                                    {{ $post->tanggungjawab }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-secondary">
                                    {{ $post->anggota }}
                                    </span>
                                </td>
                                @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2 || auth()->user()->id_level == 3 || auth()->user()->id_level == 4 || auth()->user()->id_level == 6)
                                <td><a href="/detailTugas/{{ $post->id }}" class="btn fa-solid fa-list bg-success p-2 text-white" data-toggle="tooltip" title="Detail Tugas"></a> </td>
                                @endif
                                {{-- @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 3 || auth()->user()->id_level == 6)
                                <td><a href="/detailTugasKetua/{{ $post->id }}" class="btn fa-solid fa-list bg-primary p-2 text-white" data-toggle="tooltip" title="Detail Tugas Ketua"></a> </td>
                                @endif --}}
                                @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2)
                                <td><a href="/tampilData/{{ $post->id }}" class="btn fa-regular fa-pen-to-square bg-warning p-2 text-white" data-toggle="tooltip" title="Edit Tugas"></a> </td>
                                @endif
                                @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2)
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                        <!-- <button type="submit" class="fa-solid fa-trash bg-danger p-2 text white"></button> -->
                                        <button type="submit" class="btn fa-solid fa-trash bg-danger p-2 text-white" data-toggle="tooltip" title="Hapus Tugas"></button>
                                    </form>
                                </td>
                                @endif

                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Post belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- PAGINATION -->
                    {{ $posts->links('pagination::bootstrap-4') }}

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
    @if(session()->has('success'))

        toastr.success('{{ session('success') }}', 'BERHASIL!');

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!');

    @endif
</script>

@endsection
