@extends('layout.main')

@section('isi')
    <h1>Admin Panel - Konfigurasi Menu</h1>

    @if(session('success'))
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


@endsection
