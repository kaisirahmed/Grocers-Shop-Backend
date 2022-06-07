@extends('admin.layouts.index')
@section('title','App Info')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                {!! Form::open([ 'method'=>'PATCH', 'route' => ['admin.system.update', $system], 'files' => true , 'class' => 'custom-validation']) !!}
                            @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:;" class="float-right">
                        <button type="reset" class="btn btn-warning">
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-info">
                            {{ __('Update') }}
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
                                    <label for="site_name">App Name</label>
                                    <input id="site_name" type="text" class="form-control @error('site_name') is-invalid @enderror" name="site_name" value="{{ $system->site_name }}" required autocomplete="site_name" autofocus>

                                    @error('site_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slogan">Slogan</label>
                                    <input id="slogan" type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" value="{{ $system->slogan }}" required autocomplete="slogan" autofocus>

                                    @error('slogan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                      </div>
                                    </div>
                                    @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror<br>
                                    <label for="logo">Previous Logo</label><br>
                                     <img class="tm-tag" src="{{ 'data:image/' . $system->imageType . ';base64,' . $system->logo }}" alt="logo">

                                    
                                </div>

                                <div class="form-group">
                                    <label for="meta_tags">Meta Tags</label><br>

                                    @foreach(json_decode($system->meta_tags) as $key => $meta_tags)
                                    <span class="tm-tag" id="pre_tag{{ str_replace('=','0',base64_encode($key+1)).$key }}">{{ $meta_tags }}<a href="javascript:;" onclick="deleteTags('pre_tag{{ str_replace('=','0',base64_encode($key+1)).$key }}')" class="tm-tag-remove" tagidtoremove="1"><i class="ti-close"></i></a></span>
                                    @endforeach
                                    <input type="hidden" id="pre_tags" name="pre_meta_tags" value="{{ implode(',',json_decode($system->meta_tags)) }}">
                                    <input id="meta_tags" type="meta_tags" class="form-control @error('meta_tags') is-invalid @enderror" name="meta_tags" value="" autocomplete="meta_tags" autofocus>

                                    @error('meta_tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
 
                            </div>

                            <div class="col-lg-6">
                            
                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input id="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ $system->meta_title }}" required autocomplete="meta_title" autofocus>

                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="textarea_editor form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="20" style="height:450px" placeholder="Enter text ...">{!! $system->meta_description !!}</textarea>

                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="javascript:;" class="float-right">
                        <button type="reset" class="btn btn-warning">
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-info">
                            {{ __('Update') }}
                        </button>
                        </a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
@endsection