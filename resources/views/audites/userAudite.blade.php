@extends('layout.main')
@section('title','Auditee')

@section('isi')

<div class="col-md-10 p-5 pt-2">
    <h3><i class="fa-solid fa-list-check mr-2"></i>DATA AUDITEE</h3><hr>
    <h4 class="tittle-1">
        <span class="span0">List</span>
        <span class="span1">Auditee</span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('audites.create') }}" class="btn btn-md btn-success mb-3">TAMBAH AUDITEE</a>
                        </div>
                        <div class="col-md-6">
                            <form action="/userAudite/search" class="form=inline" method="GET">
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
                        @forelse ($audites as $audite)
                            <tr>

                                <td class="text">
                                    {{ $audite->nama }}
                                </td>
                                <td class="text">
                                    {{ $audite->nip }}
                                </td>
                                <td class="text">
                                    {{ $audite->nidn }}
                                </td>
                                <td class="text">
                                    {{ $audite->jabatan }}
                                </td>


                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Auditee belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- PAGINATION (Hilangi -- nya)-->
                    {{-- $audites->links() --}}

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
