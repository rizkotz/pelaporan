@extends('layout.main')
@section('title', 'Unit Kerja')
@section('isi')

    <div class="col-md-16 p-4 pt-2">
        <h3><i class="fa-regular fa-bookmark mr-2"></i>UNIT KERJA</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">List</span>
            <span class="span1">Unit Kerja</span>
        </h4>
        <div class="row">
            <div class="col-md-5 mb-2">
                <form action="/unitKerja/search" class="form=inline" method="GET">
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
                                <button class="btn btn-md btn-success mb-1" data-toggle="modal"
                                    data-target="#addUnitKerjaModal">TAMBAH UNIT</button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Unit Kerja</th>
                                    <th colspan="2" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = ($unitKerjas->currentPage() - 1) * $unitKerjas->perPage() + 1; @endphp
                                @forelse ($unitKerjas as $unit)
                                    <tr>
                                        <td class="text-center">
                                            {{ $no++ }}
                                        </td>
                                        <td class="text-center">
                                            {{ $unit->nama_unit_kerja }}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn fa-regular fa-pen-to-square bg-warning p-2 text-white"
                                                data-toggle="modal" data-target="#editUnitKerjaModal"
                                                data-id="{{ $unit->id }}" data-nama="{{ $unit->nama_unit_kerja }}"
                                                title="Edit Unit"></button>
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('unit-kerja.destroy', $unit->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn fa-solid fa-trash bg-danger p-2 text-white"
                                                    title="Hapus Unit"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Unit Kerja belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- PAGINATION (Hilangi -- nya)-->
                        {{ $unitKerjas->links('pagination::bootstrap-4') }}

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Unit Kerja Modal --}}
    <div class="modal fade" id="addUnitKerjaModal" tabindex="-1" aria-labelledby="addUnitKerjaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('unit-kerja.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUnitKerjaModalLabel">Tambah Unit Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-grup">
                            <label for="nama_unit_kerja">Nama Unit Kerja</label>
                            <input type="text" name="nama_unit_kerja" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Unit Kerja Modal --}}
    <div class="modal fade" id="editUnitKerjaModal" tabindex="-1" aria-labelledby="editUnitKerjaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('unit-kerja.update', ['unit_kerja' => 0]) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUnitKerjaModalLabel">Edit Unit Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-grup">
                            <label for="edit_nama_unit_kerja">Nama Unit Kerja</label>
                            <input type="text" name="nama_unit_kerja" id="edit_nama_unit_kerja" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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

        // Edit modal data
        $('#editUnitKerjaModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nama = button.data('nama')

            var modal = $(this)
            modal.find('#edit_nama_unit_kerja').val(nama)

            var action = '/unit-kerja/' + id
            $('#editForm').attr('action', action)
        })
    </script>

@endsection
