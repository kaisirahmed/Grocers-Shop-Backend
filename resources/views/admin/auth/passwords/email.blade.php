@extends('admin.auth.login.login')
@section('title','Password Reset')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-4">
        <div class="login-content card">
            <div class="login-form">
                <h4>{{ __('Admin Password Reset') }}</h4>
                <form method="POST" action="{{ route($passwordEmailRoute) }}">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">
                        {{ __('Send Password Reset Link') }}
                    </button>
                   
                </form>
            </div>
        </div>
    </div>
</div>
 
@endsection
