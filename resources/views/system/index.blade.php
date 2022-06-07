@extends('admin.layouts.index')
@section('title','App Info')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(!empty($system))
                    <div class="card-header">
                    @can('edit')
                        
                        <div class="float-right">
                            <a href="{{ route('admin.system.destroy', $system->id) }}" onclick="confirmDelete('{{ $system->id }}')" class="btn btn-danger">
                                {{ __('Delete') }}
                            </a>
                            <a href="{{ route('admin.system.edit', $system->id) }}" class="btn btn-warning">
                                {{ __('Edit') }}
                            </a>
                        </div>
                        
                        <form id="delete{{ $system->id }}" action="{{ route('admin.system.destroy', $system->id) }}" method="POST" style="display: none;">
                            @csrf
                            {{ method_field('DELETE') }}
                        </form>
                        
                    @endcan
                    </div>
                    @endif
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
                            @if(!empty($system))
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="site_name">App Name</label>
                                    <span class="tm-tag form-control"><span>{{ $system->site_name }}
                                    </span></span> 
                                </div>

                                <div class="form-group">
                                    <label for="slogan">Slogan</label>
                                    <span class="tm-tag form-control">{{ $system->slogan }}</span> 
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo</label><br/>
                                     <img class="tm-tag" src="{{ 'data:image/' . $system->imageType . ';base64,' . $system->logo }}" alt="logo">
                                </div>

                                <div class="form-group">
                                    <label for="meta_tags">Meta Tags</label><br>
                                    @if(count(json_decode($system->meta_tags)) > 0)
                                        @foreach(json_decode($system->meta_tags) as $meta_tags)
                                            <span class="tm-tag">{{ $meta_tags }}</span>
                                        @endforeach
                                    @else
                                        <span class="tm-tag">No Tags to show</span>
                                    @endif
                                </div>
 
                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <span class="tm-tag form-control">{{ $system->meta_title }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <span class="tm-tag" style="padding: 10px">{!! $system->meta_description !!}</span>
                                </div>
 
                            </div>
                            @else 
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a href="{{ route('admin.system.create') }}" class="btn btn-primary"><i class="ti-layout-grid2"></i> Create App Info</a>
                                </div>
                                
                            </div>
                            @endif
                        </div>
                   
                    </div>
                </div>
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
@endsection