@extends('layout.main')
@section('title', 'Dokumen Tindak Lanjut')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa-regular fa-file mr-2"></i>DOKUMEN TINDAK LANJUT</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">List</span>
            <span class="span1">Dokumen</span>
        </h4>
        <div class="row">
            <div class="col-md-5 mb-2">
                <form action="/tindakLanjut/search" class="form=inline" method="GET">
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

                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th colspan="2" scope="col">Dokumen</th>
                                    <th scope="col">Waktu Pengumpulan</th>
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
                                            {{ $post->judul_tindak_lanjut }}
                                        </td>
                                        <td class="text">
                                            {{ $post->dokumen_tindak_lanjut }}
                                        </td>
                                        <td>
                                            <!-- Tambahkan tombol atau tautan untuk membuka dokumen -->
                                            <a href="{{ asset('dokumen_tindaklanjut/' . $post->dokumen_tindak_lanjut) }}"
                                                target="_blank" class="btn btn-info btn-sm" title="Buka Dokumen">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($post['tindakLanjut_at'])->format('d F Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Dokumen belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- PAGINATION (Hilangi -- nya)-->
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
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>

@endsection
