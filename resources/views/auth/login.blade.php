@extends('layouts.layout_pages')
@section('title','Masuk Sebagai Pengguna')

@section('content')
<div class="container-fluid mt-2">
    <div class="row my-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Masuk / Daftar') }}</div>
                <form method="POST" action="{{ route('login') }}">
                    <div class="card-body">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-info btn-block" href="{{ route('register') }}">Register</a>
                            </div>
                            <div class="col-4">
                                <a class="btn btn-info btn-block" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>      
                            </div>
                        </div>          
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
