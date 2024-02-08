@extends('layout.main')
@section('title','Anggota')

@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa-solid fa-list-check mr-2"></i>DATA ANGGOTA</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">List</span>
        <span class="span1">Anggota</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('anggotas.create') }}" class="btn btn-md btn-success mb-3">TAMBAH ANGGOTA</a>
                        </div>
                        <div class="col-md-6">
                            <form action="/userAnggota/search" class="form=inline" method="GET">
                                <div class="input-group mb-5">
                                <input type="search" name="search" class="form-control float-right" placeholder="Search: Masukkan Nama...">
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
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">NIDN</th>
                            <th scope="col">Jabatan</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($anggotas as $anggota)
                            <tr>

                                <td class="text">
                                    {{ $anggota->nama }}
                                </td>
                                <td class="text">
                                    {{ $anggota->nip }}
                                </td>
                                <td class="text">
                                    {{ $anggota->nidn }}
                                </td>
                                <td class="text">
                                    {{ $anggota->jabatan }}
                                </td>


                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Anggota belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- PAGINATION (Hilangi -- nya)-->
                    {{-- $anggotas->links() --}}

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
