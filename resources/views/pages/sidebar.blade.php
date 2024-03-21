<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard.index') }}" class="brand-link">
    <img src="{{ asset('dist/img/logo-bawaslu.png') }}" alt="Bawaslu Logo" class="brand-image">
    <span class="brand-text font-weight-light">BAWASLU</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('dist/img/avatar.png') }}"
          class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}"
            class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill me-2"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">TABLE</li>
        @if (auth()->user()->hasRole('bawaslu-provinsi'))
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('parpols.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Partai Politik
              </p>
            </a>
          </li>
        @endif
        @if (auth()->user()->hasRole('bawaslu-provinsi'))
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('jenispelanggaran.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Jenis Pelanggaran
              </p>
            </a>
          </li>
        @endif

        @if (auth()->user()->hasRole('bawaslu-provinsi') ||
                auth()->user()->hasRole('bawaslu-kota') ||
                auth()->user()->hasRole('panwascam'))
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('suratkerja.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Surat Kerja
              </p>
            </a>
          </li>
        @endif

        @if (auth()->user()->hasRole('bawaslu-provinsi') ||
                auth()->user()->hasRole('bawaslu-kota') ||
                auth()->user()->hasRole('panwascam'))
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('pelanggaran.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Pelanggaran
              </p>
            </a>
          </li>
        @endif

        @if (auth()->user()->hasRole('bawaslu-provinsi') ||
                auth()->user()->hasRole('bawaslu-kota') ||
                auth()->user()->hasRole('panwascam'))
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                Laporan Pelanggaran
              </p>
            </a>
          </li>
        @endif

        @if (auth()->user()->hasRole('bawaslu-provinsi'))
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
              <i class="bi bi-list-ul me-2"></i>
              <p>
                List Users
              </p>
            </a>
          </li>
        @endif

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
