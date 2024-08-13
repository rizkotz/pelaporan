
@foreach ($level_menus as $level_menu)
@php

    $menu = $menus->where('id', $level_menu->id_menu)->first();
@endphp

<li class="nav-item">
  <a href="{{ $menu->link }}" class="nav-link">
    <i class="nav-icon {{ $menu->icon }}"></i>
    <p>
      {{ $menu->name }}
    </p>
  </a>
  <hr class="bg-secondary mt-auto mb-auto">
</li>
@endforeach



<li class="nav-item">
    <a href="/logout" class="nav-link">
      <i class="nav-icon fa-solid fa-right-from-bracket"></i>
      <p>
        Logout
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>

