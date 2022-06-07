@extends('admin.layouts.index')
@section('title','CMS')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
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
                        @if (session()->has('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>   
                                <strong>{!! session('warning') !!}</strong>
                            </div>
                        @endif
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#page" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Page</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#content" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Content</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#content_bangla" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Content Bangla</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#seo" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">SEO</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="page" role="tabpanel">
                                <div class="p-20">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Column Name</th>
                                            <th>Details</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>{{ $cms->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Name Bangla</td>
                                                <td>{{ $cms->name_bn }}</td>
                                            </tr>
                                            <tr>
                                                <td>Permalink</td>
                                                <td>{{ $cms->slug }}</td>
                                            </tr>
                                            <tr>
                                                <td>Visibility</td>
                                                <td>
                                                    <span class="badge badge-{{ $cms->visibility === 1 ? 'success' : 'warning' }}">{{ $cms->visibility === 1 ? 'Public' : 'Private' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>
                                                    <span class="badge badge-{{ $cms->status === 1 ? 'success' : 'warning' }}">{{ $cms->status === 1 ? 'Active' : 'Inactive' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>@datetime($cms->created_at)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="content" role="tabpanel">
                                {!! $cms->content !!}
                            </div>

                            <div class="tab-pane p-20" id="content_bangla" role="tabpanel">
                                {!! $cms->content_bn !!}
                            </div>

                            <div class="tab-pane p-20" id="seo" role="tabpanel">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Column Name</th>
                                        <th>Details</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Meta Title</td>
                                            <td>{{ $cms->meta_title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Meta Tags</td>
                                            <td>
                                            @if($cms->meta_tags !== null)
                                                @foreach(json_decode($cms->meta_tags) as $meta_tags)
                                                    <p class="tm-tag">{{ $meta_tags }}</p>
                                                @endforeach 
                                                
                                            @else
                                                <p class="tm-tag">No Tags to show</p>
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Meta Description</td>
                                            <td>{!! $cms->meta_description !!}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
</div>  
@endsection