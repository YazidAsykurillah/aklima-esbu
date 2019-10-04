@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama (tanpa gelar)') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="dokumen_pendukung" class="col-md-4 col-form-label text-md-right">{{ __('Dokumen Pendukung') }}</label>

                            <div class="col-md-6">
                                <input id="dokumen_pendukung" type="file" class="form-control{{ $errors->has('dokumen_pendukung') ? ' is-invalid' : '' }}" name="dokumen_pendukung" required>
                                @if ($errors->has('dokumen_pendukung'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dokumen_pendukung') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bentuk_badan_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Bentuk Badan Usaha') }}</label>

                            <div class="col-md-6">
                                <select name="bentuk_badan_usaha" class="form-control{{ $errors->has('bentuk_badan_usaha') ? ' is-invalid' : '' }}" required>
                                    <option value="">---</option>
                                    <option value="PT">PT</option>
                                    <option value="Koperasi">Koperasi</option>
                                    <option value="CV">CV</option>
                                </select>

                                @if ($errors->has('bentuk_badan_usaha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bentuk_badan_usaha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_badan_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Nama Badan Usaha') }}</label>

                            <div class="col-md-6">
                                <input id="nama_badan_usaha" type="text" class="form-control{{ $errors->has('nama_badan_usaha') ? ' is-invalid' : '' }}" name="nama_badan_usaha" value="{{ old('nama_badan_usaha') }}" required autofocus>

                                @if ($errors->has('nama_badan_usaha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_badan_usaha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npwp_badan_usaha" class="col-md-4 col-form-label text-md-right">{{ __('NPWP Badan Usaha') }}</label>

                            <div class="col-md-6">
                                <input id="npwp_badan_usaha" type="text" class="form-control{{ $errors->has('npwp_badan_usaha') ? ' is-invalid' : '' }}" name="npwp_badan_usaha" value="{{ old('npwp_badan_usaha') }}" required autofocus>

                                @if ($errors->has('npwp_badan_usaha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('npwp_badan_usaha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scan_npwp" class="col-md-4 col-form-label text-md-right">{{ __('Scan NPWP') }}</label>

                            <div class="col-md-6">
                                <input id="scan_npwp" type="file" class="form-control{{ $errors->has('scan_npwp') ? ' is-invalid' : '' }}" name="scan_npwp" required>
                                @if ($errors->has('scan_npwp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('scan_npwp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <div class="captcha">
                                   <span>{!! captcha_img('flat') !!}</span>
                                   <button type="button" class="btn btn-success" id="refresh-captcha">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="captcha" class="col-md-4 col-form-label text-md-right">
                                {{ __('Capthca') }}
                            </label>
                            <div class="col-md-6">
                                <input id="captcha" type="text" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" required>
                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#refresh-captcha').on('click', function(){
            $.ajax({
                type:'GET',
                url:'refreshcaptcha',
                success:function(data){
                    $(".captcha span").html(data.captcha);
                 }
            });
        });
    });
</script>
@endsection
