@extends('admin.auth.login.login')
@section('title','Password Reset')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="login-content card">
            <div class="login-form">
                <h4>{{ $title }}</h4>
                <form method="POST" action="{{ route($passwordUpdateRoute) }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

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
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                     
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">{{ __('Reset Password') }}</button>
                  
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection
