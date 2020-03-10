<ul class="nav nav-tabs" id="myTab2" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{{ (Request::segment(3)=='' ? 'active' : '') }}}" id="tab-outline-identitas-badan-usaha" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'') }}" >
            <i class="fas fa-file-alt"></i> Identitas Badan Usaha
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{{ (Request::segment(3)=='outline-persyaratan-administratif' ? 'active' : '') }}}" id="tab-outline-persyaratan-administratif" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/outline-persyaratan-administratif') }}">
            <i class="fas fa-file-alt"></i> Persyaratan Administratif
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{{ (Request::segment(3)=='outline-persyaratan-teknis' ? 'active' : '') }}}" id="tab-outline-persyaratan-teknis" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/outline-persyaratan-teknis') }}">
            <i class="fas fa-file-alt"></i> Persyaratan Teknis
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{{ (Request::segment(3)=='outline-data-pengurus' ? 'active' : '') }}}" id="tab-outline-data-pengurus" href="{{ url('permohonan/'.$permohonan->uid_permohonan.'/outline-data-pengurus') }}">
            <i class="fas fa-file-alt"></i> Data Pengurus
        </a>
    </li>
</ul>