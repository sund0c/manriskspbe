<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ \Route::is('dashboard') ? 'active':'' }}">
                <i class="fas fa-home nav-icon"></i><p>Home</p>
            </a>
        </li>

        @if (auth()->user()->hasRole('admin'))
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-briefcase nav-icon"></i>
                <p>Master Data</p>
                <i class="right fas fa-angle-left"></i>
            </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('user.tampil') }}" class="nav-link {{ \Route::is('user.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('opd.tampil') }}" class="nav-link {{ \Route::is('opd.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Opd</p> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategorise.tampil') }}" class="nav-link {{ \Route::is('kategorise.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Kategori SE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dampakvital.tampil') }}" class="nav-link {{ \Route::is('dampakvital.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Vitalitas SE</p>
                        </a>
                    </li>                                    
                    <li class="nav-item">
                        <a href="{{ route('layananspbe.tampil') }}" class="nav-link {{ \Route::is('layananspbe.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Layanan SPBE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('klasifikasi.tampil') }}" class="nav-link {{ \Route::is('klasifikasi.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Klasifikasi SE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('annex.tampil') }}" class="nav-link {{ \Route::is('annex.*') ? 'active':'' }}">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Annex A Controls</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bup-db') }}" class="nav-link">
                        <i class="fas fa-angle-right nav-icon"></i>
                            <p>Full Backup</p>
                        </a>
                    </li>
                </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-briefcase nav-icon"></i>
                <p>RISIKO</p>
                <i class="right fas fa-angle-left"></i>
            </a>
                <ul class="nav nav-treeview">                   
                    <li class="nav-item">
                        <a href="{{ route('inherentrisiko.tampil') }}" class="nav-link {{ \Route::is('inherentrisiko.*') ? 'active':'' }}">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>Inherent Risk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('areadampak.tampil') }}" class="nav-link {{ \Route::is('areadampak.*') ? 'active':'' }}">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>Kriteria Dampak</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kriteriakemungkinan.tampil') }}" class="nav-link {{ \Route::is('kriteriakemungkinan.*') ? 'active':'' }}">
                            <i class="fas fa-angle-right nav-icon"></i>
                            <p>Kriteria Kemungkinan</p>
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
        <li class="nav-item">
            <a href="{{ route('asetr.tampil') }}" class="nav-link {{ \Route::is('asetr.*') ? 'active':'' }}">
                <i class="fas fa-laptop-code nav-icon"></i><p>Risiko Aset SPBE</p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
