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
                                     <a class="nav-link {{{ (Request::is('master-data/jenis-usaha') ? 'active' : '') }}}" href="{{ url('master-data/jenis-usaha') }}">
                                        <span class="ml-3"></span>Jenis Usaha
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/bidang') ? 'active' : '') }}}" href="{{ url('master-data/bidang') }}">
                                        <span class="ml-3"></span>Bidang
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/sub-bidang') ? 'active' : '') }}}" href="{{ url('master-data/sub-bidang') }}">
                                        <span class="ml-3"></span>Sub Bidang
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/matriks-kualifikasi') ? 'active' : '') }}}" href="{{ url('master-data/matriks-kualifikasi') }}">
                                        <span class="ml-3"></span>Matriks Kualifikasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/provinsi') ? 'active' : '') }}}" href="{{ url('master-data/provinsi') }}">
                                        <span class="ml-3"></span>Provinsi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/kota') ? 'active' : '') }}}" href="{{ url('master-data/kota') }}">
                                        <span class="ml-3"></span>Kota
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/kecamatan') ? 'active' : '') }}}" href="{{ url('master-data/kecamatan') }}">
                                        <span class="ml-3"></span>Kecamatan
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/kelurahan') ? 'active' : '') }}}" href="{{ url('master-data/kelurahan') }}">
                                        <span class="ml-3"></span>Kelurahan
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/asesor') ? 'active' : '') }}}" href="{{ url('master-data/asesor') }}">
                                        <span class="ml-3"></span>Asesor
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/badan-usaha') ? 'active' : '') }}}" href="{{ url('master-data/badan-usaha') }}">
                                        <span class="ml-3"></span>Badan Usaha
                                    </a>
                                </li>                   
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(\Auth::user()->can('access-configuration'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#configuration" aria-controls="configuration"><i class="fa fa-fw fa-cogs"></i>Configurations</a>
                        <div id="configuration" class="{{{ (Request::is('configuration/*') ? '' : 'collapse') }}} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('configuration/service-integrator') ? 'active' : '') }}}" href="{{ url('configuration/service-integrator') }}">
                                        <span class="ml-3"></span>Service Integrator
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