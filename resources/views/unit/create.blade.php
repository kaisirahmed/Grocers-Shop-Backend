@extends('admin.layouts.index')
@section('title','Products Unit')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            {!! Form::open([ 'method'=>'POST', 'route' => ['unit.store'], 'files' => true , 'class' => 'custom-validation']) !!}
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:;" class="float-right">
                        <button type="reset" class="btn btn-warning">
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-info">
                            {{ __('save') }}
                        </button>
                        </a>
                    </div>
                    <div class="card-body">
                         
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>   
                                <strong>{!! session('message') !!}</strong>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="short_format">Unit Short Name</label>
                                    <input type="text" class="form-control @error('short_format') is-invalid @enderror" name="short_format" value="{{ old('short_format') }}" required autofocus>

                                    @error('short_format')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="full_format">Unit Full Name</label>
                                    <input type="text" class="form-control @error('full_format') is-invalid @enderror" name="full_format" value="{{ old('full_format') }}" required autofocus>

                                    @error('full_format')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                          
                    </div>
                   
                </div>
                {{ Form::close() }}
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  

@endsection