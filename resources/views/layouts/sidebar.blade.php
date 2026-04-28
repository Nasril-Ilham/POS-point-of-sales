<style>
    /* Memastikan pembungkus sidebar selalu setinggi layar */
    .main-sidebar {
        min-height: 100vh !important;
        position: fixed; /* Opsional: Agar sidebar tetap diam saat konten di-scroll */
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ url('/') }}" class="brand-link">
    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">PWL starter code</span>
  </a>

  <div class="sidebar">
    <div class="form-inline mt-3">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link {{ ($activemenu == 'dasboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">data pengguna</li>
        <li class="nav-item">
          <a href="{{ url('/level') }}" class="nav-link {{ ($activemenu == 'level') ? 'active' : '' }}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              level user
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/user') }}" class="nav-link {{ ($activemenu == 'user') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Data user
              <span class="badge badge-info right">6</span>
            </p>
          </a>
        </li>

        <li class="nav-header">Data barang</li>
        <li class="nav-item">
          <a href="{{ url('/kategori') }}" class="nav-link {{ ($activemenu == 'kategori') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Kategori barang
              <span class="badge badge-info right">6</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/barang') }}" class="nav-link {{ ($activemenu == 'barang') ? 'active' : '' }}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>
              Data barang
              <span class="badge badge-info right">6</span>
            </p>
          </a>
        </li>

        <li class="nav-header">data transaksi</li>
        <li class="nav-item">
          <a href="{{ url('/stock') }}" class="nav-link {{ ($activemenu == 'stock') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              stock barang
              <span class="badge badge-info right">6</span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activemenu == 'penjualan') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              transaksi penjualan
              <span class="badge badge-info right">6</span>
            </p>
          </a>
        </li>
      </ul>    
    </nav>
  </div>
</aside>