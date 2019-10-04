@extends('layouts.app')

@section('page_title')
    Dashboard
@endsection

@section('page_header_title')
<h2 class="pageheader-title">Dashboard</h2>
@endsection

@section('page_breadcrumb')
<div class="page-breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="breadcrumb-link">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-section" id="overview">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2>Selamat datang</h2>
                    <p class="lead">
                        Selamat datang di aplikasi eSBU Aklima
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Change Password
            </div>
            <div class="card-body">
                <p class="card-text">
                    <i class="fa fa-info-circle"></i> Anda baru pertama kali masuk, silahkan ubah password dengan klik tombol berikut
                </p>
                <a href="#" class="btn btn-primary">Ubah Password</a>
            </div>
        </div>
    </div>
</div>
@endsection
