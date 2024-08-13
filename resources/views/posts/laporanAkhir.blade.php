@extends('layout.main')
@section('title', 'Laporan Akhir')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa-solid fa-list-check mr-2"></i>LAPORAN AKHIR</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">List</span>
            <span class="span1">Tugas</span>
        </h4>
        <div class="row">
            <div class="col-md-6 mb-2">
                <form action="/laporanAkhir/searchAkhir" method="GET">
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
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">PIC</th>
                                        <th scope="col">Anggota</th>
                                        <th scope="col">Status</th>
                                        <th colspan="4" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $no = ($posts->currentPage() - 1) * $posts->perPage() + 1; @endphp
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td class="text-center">
                                                {{ $no++ }}
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
                                                <span class="badge badge-secondary">
                                                {{ $post->tanggungjawab }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                {{ $post->anggota }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-success">Selesai</span>
                                            </td>
                                            @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2 || auth()->user()->id_level == 4)
                                                <td><a href="/detailTugas/{{ $post->id }}"
                                                        class="btn fa-solid fa-list bg-success p-2 text-white"
                                                        data-toggle="tooltip" title="Detail Tugas"></a> </td>
                                            @endif
                                            @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 3 || auth()->user()->id_level == 6)
                                                <td><a href="/detailTugasKetua/{{ $post->id }}"
                                                        class="btn fa-solid fa-list bg-primary p-2 text-white"
                                                        data-toggle="tooltip" title="Detail Tugas Ketua"></a> </td>
                                            @endif
                                            <td><a href="{{ route('tambahTindakLanjut', ['id' => $post->id]) }}"
                                                class="btn fa-solid fa-plus bg-warning p-2 text-white"
                                                data-toggle="tooltip" title="Tambah Tindak Lanjut"></a> </td>
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
