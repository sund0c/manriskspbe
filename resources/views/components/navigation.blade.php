<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ \Route::is('dashboard') ? 'active':'' }}">
                <i class="far fa-home nav-icon"></i><p>Home</p>
            </a>
        </li>

        @if (auth()->user()->hasRole('admin'))
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-briefcase nav-icon"></i>
                <p>Master Data</p>
                <i class="right fas fa-angle-left"></i>
            </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user.tampil') }}" class="nav-link {{ \Route::is('user.*') ? 'active':'' }}">
                            <i class="far fa-users nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('opd.tampil') }}" class="nav-link {{ \Route::is('opd.*') ? 'active':'' }}">
                            <i class="far fa-building nav-icon"></i>
                            <p>Opd</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategorise.tampil') }}" class="nav-link {{ \Route::is('kategorise.*') ? 'active':'' }}">
                            <i class="far fa-exclamation nav-icon"></i>
                            <p>Kategori SE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('layananspbe.tampil') }}" class="nav-link {{ \Route::is('layananspbe.*') ? 'active':'' }}">
                            <i class="fas fa-laptop-code nav-icon"></i>
                            <p>Layanan SPBE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('klasifikasi.tampil') }}" class="nav-link {{ \Route::is('klasifikasi.*') ? 'active':'' }}">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <p>Klasifikasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('annex.tampil') }}" class="nav-link {{ \Route::is('annex.*') ? 'active':'' }}">
                            <i class="far fa-list nav-icon"></i>
                            <p>Annex A Controls</p>
                        </a>
                    </li>
                </ul>
        </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('aset.tampil') }}" class="nav-link {{ \Route::is('aset.*') ? 'active':'' }}">
                <i class="fas fa-laptop-code nav-icon"></i><p>Aset SPBE</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
