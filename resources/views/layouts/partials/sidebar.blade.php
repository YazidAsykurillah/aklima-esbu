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
                            <i class="fa fa-fw fa-home"></i>Dashboard
                        </a>
                    </li>
                    @if(\Auth::user()->can('view-permohonan'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#permohonan" aria-controls="permohonan"><i class="fa fa-fw fa-list"></i>Permohonan</a>
                        <div id="permohonan" class="{{{ (Request::is('permohonan*') ? 'show' : 'collapse') }}} submenu" style="">
                            <ul class="nav flex-column">
                                @if(\Auth::user()->can('view-permohonan-all'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::query('status') == 'all' ? 'active' : '') }}}" href="{{ url('permohonan/?status=all') }}">
                                        <span class=""></span>All
                                    </a>
                                </li>
                                @endif
                                @if(\Auth::user()->can('view-permohonan-0'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::query('status') == '0' ? 'active' : '') }}}" href="{{ url('permohonan/?status=0') }}">
                                        <span class=""></span>Menunggu Dokumen <text id="permohonan_0_count"></text>
                                    </a>
                                </li>
                                @endif
                                @if(\Auth::user()->can('view-permohonan-1'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::query('status') == '1' ? 'active' : '') }}}" href="{{ url('permohonan/?status=1') }}">
                                        <span class=""></span>Verifikasi Asesor TT <text id="permohonan_1_count"></text>
                                    </a>
                                </li>
                                @endif
                                @if(\Auth::user()->can('view-permohonan-4'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::query('status') == '4' ? 'active' : '') }}}" href="{{ url('permohonan/?status=4') }}">
                                        <span class=""></span>Verifikasi Asesor PJT <text id="permohonan_4_count"></text>
                                    </a>
                                </li>
                                @endif
                                @if(\Auth::user()->can('view-permohonan-5'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::query('status') == '5' ? 'active' : '') }}}" href="{{ url('permohonan/?status=5') }}">
                                        <span class=""></span>Verifikasi LSBU Pusat <text id="permohonan_5_count"></text>
                                    </a>
                                </li>
                                @endif
                                @if(\Auth::user()->can('view-permohonan-7'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::query('status') == '7' ? 'active' : '') }}}" href="{{ url('permohonan/?status=7') }}">
                                        <span class=""></span>DJK Prepare <text id="permohonan_7_count"></text>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(\Auth::user()->can('view-sertifikat'))
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('sertifikat') ? 'active' : '') }}}" href="{{ url('sertifikat')}}">
                            <i class="fa fa-fw fa-file-alt"></i>Sertifikat
                        </a>
                    </li>
                    @endif

                    @if(\Auth::user()->can('access-master-data'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#master-data" aria-controls="master-data"><i class="fa fa-fw fa-database"></i>Master Data / Referensi</a>
                        <div id="master-data" class="{{{ (Request::is('master-data/*') ? 'show' : 'collapse') }}} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{{ (Request::is('master-data/bentuk-badan-usaha') ? 'active' : '') }}}" href="{{ url('master-data/bentuk-badan-usaha')}}">
                                        <span class=""></span>Bentuk Badan Usaha
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/jenis-usaha') ? 'active' : '') }}}" href="{{ url('master-data/jenis-usaha') }}">
                                        <span class=""></span>Jenis Usaha
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/bidang') ? 'active' : '') }}}" href="{{ url('master-data/bidang') }}">
                                        <span class=""></span>Bidang
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/sub-bidang') ? 'active' : '') }}}" href="{{ url('master-data/sub-bidang') }}">
                                        <span class=""></span>Sub Bidang
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/matriks-kualifikasi') ? 'active' : '') }}}" href="{{ url('master-data/matriks-kualifikasi') }}">
                                        <span class=""></span>Matriks Kualifikasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/provinsi') ? 'active' : '') }}}" href="{{ url('master-data/provinsi') }}">
                                        <span class=""></span>Provinsi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/kota') ? 'active' : '') }}}" href="{{ url('master-data/kota') }}">
                                        <span class=""></span>Kota
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/kecamatan') ? 'active' : '') }}}" href="{{ url('master-data/kecamatan') }}">
                                        <span class=""></span>Kecamatan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{{ (Request::is('master-data/kelurahan') ? 'active' : '') }}}" href="{{ url('master-data/kelurahan') }}">
                                        <span class=""></span>Kelurahan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{{ (Request::is('master-data/lsbu-wilayah') ? 'active' : '') }}}" href="{{ url('master-data/lsbu-wilayah') }}">
                                        <span class=""></span>LSBU Wilayah
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{{ (Request::is('master-data/lingkup-pekerjaan-lsbu') ? 'active' : '') }}}" href="{{ url('master-data/lingkup-pekerjaan-lsbu') }}">
                                        <span class=""></span>Lingkup Pekerjaan LSBU
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/asesor') ? 'active' : '') }}}" href="{{ url('master-data/asesor') }}">
                                        <span class=""></span>Asesor
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('master-data/badan-usaha') ? 'active' : '') }}}" href="{{ url('master-data/badan-usaha') }}">
                                        <span class=""></span>Badan Usaha
                                    </a>
                                </li>                   
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(\Auth::user()->can('access-service'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#service" aria-controls="service"><i class="fa fa-fw fa-cogs"></i>Services</a>
                        <div id="service" class="submenu {{{ (Request::is('service/*') ? 'show' : 'collapse') }}}" style="">
                            <ul class="nav flex-column">
                                @if(\Auth::user()->can('access-tarik-pendaftaran'))
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('service/tarik-pendaftaran') ? 'active' : '') }}}" href="{{ url('service/tarik-pendaftaran') }}">
                                        <span class=""></span>Tarik Pendaftaran
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @endif
                    
                    @if(\Auth::user()->can('access-configuration'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#configuration" aria-controls="configuration"><i class="fa fa-fw fa-cogs"></i>Configurations</a>
                        <div id="configuration" class="{{{ (Request::is('configuration/*') ? 'show' : 'collapse') }}} submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                     <a class="nav-link {{{ (Request::is('configuration/service-integrator') ? 'active' : '') }}}" href="{{ url('configuration/service-integrator') }}">
                                        <span class=""></span>Service Integrator
                                    </a>
                                </li>                
                            </ul>
                        </div>
                    </li>
                    @endif
                    @if(\Auth::user()->can('view-user'))
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('user') ? 'active' : '') }}}" href="{{ url('user')}}">
                            <i class="fa fa-fw fa-users"></i> User
                        </a>
                    </li>
                    @endif

                    @if(\Auth::user()->can('access-role'))
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('role') ? 'active' : '') }}}" href="{{ url('role')}}">
                            <i class="fa fa-fw fa-list"></i> Role
                        </a>
                    </li>
                    @endif

                    @if(\Auth::user()->can('access-permission'))
                    <li class="nav-item">
                        <a class="nav-link {{{ (Request::is('permission') ? 'active' : '') }}}" href="{{ url('permission')}}">
                            <i class="fa fa-fw fa-lock"></i> Permission
                        </a>
                    </li>
                    @endif
                    
                </ul>
            </div>
        </nav>
    </div>
</div>