<style>
    /* Memastikan pembungkus sidebar selalu setinggi layar */
    .main-sidebar {
        min-height: 100vh !important;
        position: fixed;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/photo') }}" class="brand-link">
        @if (Auth::check() && Auth::user()->image)
            <img src="{{ asset('storage/photos/' . Auth::user()->image) }}" class="brand-image img-circle elevation-3"
                style="opacity: .8; width: 33px; height: 33px; object-fit: cover;"
                onerror="this.src='{{ asset('adminlte/dist/img/AdminLTELogo.png') }}';">
        @else
            <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" class="brand-image img-circle elevation-3">
        @endif
        <span class="brand-text font-weight-light">Inventory App</span>
    </a>

    <div class="sidebar rounded-2xl">
        <div class="form-inline mt-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">Data Pengguna</li>
                <li class="nav-item">
                    <a href="{{ url('/level') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'level' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Level User</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ url('/user') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'user' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i> {{-- Icon diganti ke users lebih cocok --}}
                        <p>Data User</p>
                    </a>
                </li>

                <li class="nav-header">Data Barang</li>
                <li class="nav-item">
                    <a href="{{ url('/kategori') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'kategori' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i> {{-- Icon diganti ke tags --}}
                        <p>Kategori Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/barang') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'barang' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Data Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/supplier') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'supplier' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i> {{-- Icon diganti ke truck --}}
                        <p>Data Supplier</p>
                    </a>
                </li>

                <li class="nav-header">Data Transaksi</li>
                <li class="nav-item">
                    <a href="{{ url('/stok') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'stok' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/penjualan') }}"
                        class="nav-link {{ isset($activemenu) && $activemenu == 'penjualan' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Transaksi Penjualan</p>
                    </a>
                </li>
                <li class="nav-header">Akun</li>
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="get">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent text-left w-100">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
