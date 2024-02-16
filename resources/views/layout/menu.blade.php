@if (auth()->check() && auth()->user()->level == 1)
@foreach ($menusLv1 as $m1)
<li class="nav-item">
  <a href="{{ $m1->link }}" class="nav-link">
    <i class="nav-icon {{ $m1->icon }}"></i>
    <p>
      {{ $m1->name }}
    </p>
  </a>
  <hr class="bg-secondary mt-auto mb-auto">
</li>
@endforeach
{{-- <li class="nav-item">
    <a href="/dashboard" class="nav-link">
      <i class="nav-icon fa-solid fa-gauge"></i>
      <p>
        Dashboard
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/posts" class="nav-link">
      <i class="nav-icon fa-solid fa-list-check"></i>
      <p>
        Reviu Laporan Keuangan
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="{{ url('dashboard') }}" class="nav-link">
      <i class="nav-icon fa-solid fa-list-check"></i>
      <p>
        Laporan Unit Kerja
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="{{ url('dashboard') }}" class="nav-link">
      <i class="nav-icon fa-solid fa-list-check"></i>
      <p>
        Audit Eksternal
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="{{ url('dashboard') }}" class="nav-link">
      <i class="nav-icon fa-solid fa-list-check"></i>
      <p>
        Laporan Hasil Pemeriksaan
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/anggotas" class="nav-link">
      <i class="nav-icon fa-solid fa-user"></i>
      <p>
        Anggota
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/audites" class="nav-link">
      <i class="nav-icon fa-regular fa-user"></i>
      <p>
        Auditee
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/dokumens" class="nav-link">
      <i class="nav-icon fa-solid fa-file"></i>
      <p>
        Dokumen
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li> --}}
<li class="nav-item">
    <a href="/logout" class="nav-link">
      <i class="nav-icon fa-solid fa-right-from-bracket"></i>
      <p>
        Logout
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
{{-- <li class="nav-item">
    <a href="/admin/panel" class="nav-link">
      <i class="nav-icon fa-solid fa-right-from-bracket"></i>
      <p>
        Setting Admin
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li> --}}

@elseif (auth()->check() && auth()->user()->level == 2)
@foreach ($menusLv2 as $m2)
<li class="nav-item">
  <a href="{{ $m2->link }}" class="nav-link">
    <i class="nav-icon {{ $m2->icon }}"></i>
    <p>
      {{ $m2->name }}
    </p>
  </a>
  <hr class="bg-secondary mt-auto mb-auto">
</li>
@endforeach
{{-- <li class="nav-item">
    <a href="/dashboard" class="nav-link">
      <i class="nav-icon fa-solid fa-gauge"></i>
      <p>
        Dashboard
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/posts" class="nav-link">
      <i class="nav-icon fa-solid fa-list-check"></i>
      <p>
        Reviu Laporan Keuangan
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/anggotas" class="nav-link">
      <i class="nav-icon fa-solid fa-user"></i>
      <p>
        Anggota
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/audites" class="nav-link">
      <i class="nav-icon fa-regular fa-user"></i>
      <p>
        Auditee
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
<li class="nav-item">
    <a href="/dokumens" class="nav-link">
      <i class="nav-icon fa-solid fa-file"></i>
      <p>
        Dokumen
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li> --}}
<li class="nav-item">
    <a href="/logout" class="nav-link">
      <i class="nav-icon fa-solid fa-right-from-bracket"></i>
      <p>
        Logout
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>

@elseif (auth()->check() && auth()->user()->level == 3)
@foreach ($menusLv3 as $m3)
<li class="nav-item">
  <a href="{{ $m3->link }}" class="nav-link">
    <i class="nav-icon {{ $m3->icon }}"></i>
    <p>
      {{ $m3->name }}
    </p>
  </a>
  <hr class="bg-secondary mt-auto mb-auto">
</li>
@endforeach
{{-- <li class="nav-item">
    <a href="/dokumens" class="nav-link">
      <i class="nav-icon fa-solid fa-file"></i>
      <p>
        Dokumen
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li> --}}
<li class="nav-item">
    <a href="/logout" class="nav-link">
      <i class="nav-icon fa-solid fa-right-from-bracket"></i>
      <p>
        Logout
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
@endif
