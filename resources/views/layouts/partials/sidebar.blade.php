<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('home') ? 'active' : '') }}}" href="{{ url('home')}}">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    @if(\Auth::user()->can('access-master-data'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#master-data" aria-controls="master-data"><i class="fa fa-fw fa-database"></i>Master Data / Referensi</a>
                        <div id="master-data" class="{{{ (Request::is('master-data/*') ? '' : 'collapse') }}} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{{ (Request::is('master-data/bentuk-badan-usaha') ? 'active' : '') }}}" href="{{ url('master-data/bentuk-badan-usaha')}}">
                                        <span class="ml-3"></span>Bentuk Badan Usaha
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Jenis Usaha
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Bidang
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Sub Bidang
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Matriks Kualifikasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Provinsi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Kota
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Kecamatan
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Kelurahan
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Asesor
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="#">
                                        <span class="ml-3"></span>Badan Usaha
                                    </a>
                                </li>                   
                            </ul>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>