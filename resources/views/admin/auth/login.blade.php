@extends('admin.auth.login.login')
@section('title','Admin Login Panel')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="login-content card">
            <div class="login-form">
                <h4>{{ __('Admin Login Panel') }}</h4>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    @if (session('warning'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <label for="remember">
                            <input type="checkbox" name="remember" id="remember" checked="{{ old('remember') ? 'checked' : '' }}">{{ __('Remember me') }}
                        </label>
                        <label class="pull-right">
                            @if (Route::has('admin.password.request'))
                                <a class="btn btn-link" href="{{ route('admin.password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i>{{ __('Forgot Password?') }}</a>
                            @endif
                        </label>

                    </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                  
                </form>
            </div>
        </div>
    </div>
</div>
@endsection