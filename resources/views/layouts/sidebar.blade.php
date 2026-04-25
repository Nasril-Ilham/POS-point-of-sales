<div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('adminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">nasril ilham</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link  {{  ($activemenu == 'dasboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          {{--  --}}
          <li class="nav-header">data pengguna</li>
          {{--  --}}
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
            <a href="{{ url('/barang') }}" class="nav-link {{ ($activemenu == 'penjualan') ? 'active' : '' }}">
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