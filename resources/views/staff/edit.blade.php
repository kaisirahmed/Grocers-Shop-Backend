@extends('admin.layouts.index')
@section('title','Staff Edit')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>   
                                <strong>{!! session('message') !!}</strong>
                            </div>
                        @endif

                        {!! Form::open([ 'method'=>'PATCH', 'route' => ['staff.update', $staff], 'files' => true , 'class' => 'custom-validation']) !!}
                            @csrf
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $staff->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $staff->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control valid" id="role" name="role" aria-required="true" aria-describedby="role" aria-invalid="false">
                                    <option disabled="disabled" selected="selected">Please select</option>
                                    <option value="account" {{ $staff->role == 'account' ? 'selected' : '' }}>Account</option>
                                    <option value="manager" {{ $staff->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                </select>
                            </div>
  
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">
                                    {{ __('Update') }}
                                </button>
                                <button type="reset" class="btn btn-warning">
                                    {{ __('Reset Changes') }}
                                </button>
                            </div>
                            
                        {{ Form::close() }}

                    </div>
                </div>
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
@endsection