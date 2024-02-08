@extends('layout.main')
@section('title','Review Laporan')
@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa-solid fa-list-check mr-2"></i>REVIEW LAPORAN KEUANGAN</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">List</span>
        <span class="span1">Tugas</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH TUGAS</a>
                        </div>
                        <div class="col-md-6">
                            <form action="/reviewLaporan/search" class="form=inline" method="GET">
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
                    </div>




                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">Waktu</th>
                            <th scope="col">Tempat</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Bidang</th>
                            <th colspan="3" scope="col" >Aksi</th>

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
                                    {{ $post->bidang }}
                                </td>

                                <td><a href="/detailTugas/{{ $post->id }}" class="btn fa-solid fa-list bg-info p-2 text-white" data-toggle="tooltip" title="Detail Tugas"></a> </td>
                                <td><a href="/tampilData/{{ $post->id }}" class="btn fa-regular fa-pen-to-square bg-warning p-2 text-white" data-toggle="tooltip" title="Edit Tugas"></a> </td>

                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                        <!-- <button type="submit" class="fa-solid fa-trash bg-danger p-2 text white"></button> -->
                                        <button type="submit" class="btn fa-solid fa-trash bg-danger p-2 text-white" data-toggle="tooltip" title="Hapus Tugas"></button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Post belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- PAGINATION (Hilangi -- nya)-->
                    {{-- $posts->links() --}}

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
