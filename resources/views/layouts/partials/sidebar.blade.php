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
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#permohonan" aria-controls="permohonan"><i class="fa fa-fw fa-cogs"></i>Permohonan</a>
                        <div id="permohonan" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=0') }}">
                                        <span class=""></span>Menunggu Dokumen
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=1') }}">
                                        <span class=""></span>Front Desk
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=2') }}">
                                        <span class=""></span>Dokumen lengkap dan proses upload
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=4') }}">
                                        <span class=""></span>Verifikator
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=5') }}">
                                        <span class=""></span>Auditor
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=6') }}">
                                        <span class=""></span>Validator
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=7') }}">
                                        <span class=""></span>Evaluator
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=10') }}">
                                        <span class=""></span>Top Approval
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=11') }}">
                                        <span class=""></span>SBU sudah diregistrasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=12') }}">
                                        <span class=""></span>SBU sudah dicetak
                                    </a>
                                </li>
                                <li class="nav-item">
                                     <a class="nav-link" href="{{ url('permohonan/?status=14') }}">
                                        <span class=""></span>SBU sudah diterima pemohon
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if(\Auth::user()->can('access-master-data'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#master-data" aria-controls="master-data"><i class="fa fa-fw fa-database"></i>Master Data / Referensi</a>
                        <div id="master-data" class="{{{ (Request::is('master-data/*') ? '' : 'collapse') }}} submenu" style="">
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

                    @if(\Auth::user()->can('access-configuration'))
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#configuration" aria-controls="configuration"><i class="fa fa-fw fa-cogs"></i>Configurations</a>
                        <div id="configuration" class="{{{ (Request::is('configuration/*') ? '' : 'collapse') }}} submenu" style="">
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
                </ul>
            </div>
        </nav>
    </div>
</div>