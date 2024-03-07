{{-- @extends('layout.main')

@section('isi')
    <h1>Admin Panel - Konfigurasi Menu</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($user)
    <p>Pengguna ditemukan. ID: {{ $user->id }}</p>
    <form method="POST" action="{{ route('admin.saveMenuConfig', ['userId' => $user->id]) }}">
        @csrf

        <div class="form-group">
            <label for="menu_config">Konfigurasi Menu JSON:</label>
            <textarea class="form-control" id="menu_config" name="menu_config" rows="5">{{ json_encode($user->menu_config) }}</textarea>
        </div>

        <div class="form-group">
            <label>Pilih Menu yang Akan Ditampilkan:</label><br>
            @foreach ($menus as $menu)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="menu_visibility[]" value="{{ $menu->id }}" {{ in_array($menu->id, $user->menu_config) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $menu->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Simpan Konfigurasi</button>
    </form>
    @else
        <p>Pengguna tidak ditemukann.</p>
    @endif


@endsection --}}

@extends('layout.main')
@section('title', 'Panel')

@section('isi')

    <div class="col-md-10 p-5 pt-2">
        <h3><i class="fa-solid fa-list-check mr-2"></i>Admin Panel - Konfigurasi Menu</h3>
        <hr>
        <h4 class="tittle-1">
            <span class="span0">Konvigurasi</span>
            <span class="span1">Menu</span>
        </h4>
        <div class="row">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        {{-- <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> --}}
                        <form action="/admin/panel" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="menu" style="font-weight: 100;">Menu</label>
                                    <input type="text" id="inputmenu" class="form-control" name="name"
                                        placeholder="Masukkan Menu" value="{{ old('menu') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="menu" style="font-weight: 100;">Link</label>
                                    <select class="custom-select" name="link">
                                        <option selected>Pilih Halaman</option>
                                        <option value="/dashboard">Dashboard</option>
                                        <option value="/dashboard">Reviu Laporan Keuangan</option>
                                        <option value="/dashboard">Laporan Unit Kerja</option>
                                        <option value="/dashboard">Audit Eksternal</option>
                                        <option value="/dashboard">Laporan Hasil Pemeriksaan</option>
                                        <option value="/anggotas">Anggota</option>
                                        <option value="/audites">Auditee</option>
                                        <option value="/users">User</option>
                                        <option value="/admin/panel">Menu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="menu" style="font-weight: 100;">Icon</label>
                                    <select class="custom-select" name="icon" style=" font-family: 'FontAwesome' ">
                                        <option value="fa-solid fa-gauge">&#xf624; </option>
                                        <option value="fa-solid fa-list-check">&#xf0ae; </option>
                                        <option value="fa-solid fa-user">&#xf007; </option>
                                        <option value="fa-regular fa-user">&#xf2bd; </option>
                                        <option value="fa-solid fa-file">&#xf15b; </option>
                                        <option value="fa-brands fa-facebook">&#xf09a; </option>
                                    </select>
                                </div>
                                <div>

                                    <label for="menu" style="font-weight: 100;">Visibility</label>
                                </div>
                                <div class="mb-3">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                                            name="ketua">
                                        <label class="custom-control-label" style="font-weight: 100;"
                                            for="customCheck1">Ketua</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2"
                                            name="anggota">
                                        <label class="custom-control-label" style="font-weight: 100;"
                                            for="customCheck2">Anggota</label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn btn-md btn-success mb-3" data-toggle="modal"
                                    data-target="#exampleModal">
                                    TAMBAH MENU
                                </button>
                                {{-- <a href="/" class="btn btn-md btn-success mb-3">TAMBAH Menu</a> --}}
                            </div>
                            <div class="col-md-6">
                                   <form action="/" class="form=inline" method="GET">
                                    <div class="input-group mb-5">
                                        <input type="search" name="search" class="form-control float-right"
                                            placeholder="Search: Masukkan Kata Kunci...">
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
                                    <th scope="col">Menu</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Ketua</th>
                                    <th scope="col">Anggota</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $menu)
                                    <tr>

                                        <td class="text">
                                            {{ $menu->name }}
                                        </td>
                                        <td class="text">
                                            <a href="{{ $menu->link }}" class="btn btn-sm btn-primary"> <i
                                                    class="fa-solid fa-link"></i> link</a>
                                        </td>
                                        <td class="text">
                                            <div class="form-check">
                                                <label>
                                                    <form action="/admin/panel/{{ $menu->id }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" id="inputmenu" class="form-control"
                                                            name="ketua"
                                                            value="{{ $menu->ketua == '1' ? 'false' : '1' }}">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-{{ $menu->ketua == '1' ? 'success' : 'secondary' }}"
                                                            style="margin:0;"
                                                            onclick="return confirm('Apakah anda yakin?')">
                                                            <i
                                                                class="fa-solid fa-{{ $menu->ketua == '1' ? 'check' : 'square' }}"></i>
                                                        </button>
                                                    </form>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text">
                                            <div class="form-check">
                                                <label>
                                                    <form action="/admin/panel/{{ $menu->id }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" id="inputmenu" class="form-control"
                                                            name="anggota"
                                                            value="{{ $menu->anggota == '1' ? 'false' : '1' }}">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-{{ $menu->anggota == '1' ? 'success' : 'secondary' }}"
                                                            style="margin:0;"
                                                            onclick="return confirm('Apakah anda yakin?')">
                                                            <i
                                                                class="fa-solid fa-{{ $menu->anggota == '1' ? 'check' : 'square' }}"></i>
                                                        </button>
                                                    </form>
                                                </label>
                                            </div>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#editModal{{ $menu->id }}">Edit</button>
                                            <form action="/admin/panel/{{ $menu->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf

                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah anda yakin?')">Delete</button>
                                            </form>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel{{ $menu->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $menu->id }}">
                                                            Edit Menu {{ $menu->name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="/admin/panel/{{ $menu->id }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="menu"
                                                                    style="font-weight: 100;">Menu</label>
                                                                <input type="text" id="inputmenu" class="form-control"
                                                                    name="name" placeholder="Masukkan Menu"
                                                                    value="{{ $menu->name }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="menu"
                                                                    style="font-weight: 100;">Link</label>
                                                                <select class="custom-select" name="link">
                                                                    <option>Pilih Halaman</option>
                                                                    <option value="/dashboard"
                                                                        {{ $menu->link == '/dashboard' ? 'selected' : '' }}>
                                                                        Dashboard</option>
                                                                    <option value="/dashboard"
                                                                        {{ $menu->link == '/dashboard' ? 'selected' : '' }}>
                                                                        Reviu Laporan Keuangan</option>
                                                                    <option value="/dashboard"
                                                                        {{ $menu->link == '/dashboard' ? 'selected' : '' }}>
                                                                        Laporan Unit Kerja</option>
                                                                    <option value="/dashboard"
                                                                        {{ $menu->link == '/dashboard' ? 'selected' : '' }}>
                                                                        Audit Eksternal</option>
                                                                    <option value="/dashboard"
                                                                        {{ $menu->link == '/dashboard' ? 'selected' : '' }}>
                                                                        Laporan Hasil Pemeriksaan</option>
                                                                    <option value="/anggotas"
                                                                        {{ $menu->link == '/anggotas' ? 'selected' : '' }}>
                                                                        Anggota</option>
                                                                    <option value="/audites"
                                                                        {{ $menu->link == '/audites' ? 'selected' : '' }}>
                                                                        Auditee</option>
                                                                    <option value="/users"
                                                                        {{ $menu->link == '/users' ? 'selected' : '' }}>
                                                                        Auditee</option>
                                                                    <option value="/admin/panel"
                                                                        {{ $menu->link == '/admin/panel' ? 'selected' : '' }}>
                                                                        Menu</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="menu"
                                                                    style="font-weight: 100;">Icon</label>
                                                                <select class="custom-select" name="icon"
                                                                    style=" font-family: 'FontAwesome' ">
                                                                    <option value="fa-solid fa-gauge"
                                                                        {{ $menu->icon == 'fa-solid fa-gauge' ? 'selected' : '' }}>
                                                                        &#xf624; </option>
                                                                    <option value="fa-solid fa-list-check"
                                                                        {{ $menu->icon == 'fa-solid fa-list-check' ? 'selected' : '' }}>
                                                                        &#xf0ae; </option>
                                                                    <option value="fa-solid fa-user"
                                                                        {{ $menu->icon == 'fa-solid fa-user' ? 'selected' : '' }}>

                                                                        &#xf007; </option>
                                                                    <option value="fa-regular fa-user"
                                                                        {{ $menu->icon == 'fa-reguler fa-user' ? 'selected' : '' }}>

                                                                        &#xf2bd; </option>
                                                                    <option value="fa-solid fa-file"
                                                                        {{ $menu->icon == 'fa-solid fa-file' ? 'selected' : '' }}>

                                                                        &#xf15b; </option>
                                                                    <option value="fa-solid fa-gear"
                                                                        {{ $menu->icon == 'fa-solid fa-gear' ? 'selected' : '' }}>

                                                                        &#xf013; </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Menu belum Tersedia.
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
        @if (session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>

@endsection
