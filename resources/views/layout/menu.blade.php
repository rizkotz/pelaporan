@if (auth()->check() && auth()->user()->level == 1)
<li class="nav-item">
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
</li>
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
<li class="nav-item">
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
</li>
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
<li class="nav-item">
    <a href="/dokumens" class="nav-link">
      <i class="nav-icon fa-solid fa-file"></i>
      <p>
        Dokumen
      </p>
    </a>
    <hr class="bg-secondary mt-auto mb-auto">
</li>
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
