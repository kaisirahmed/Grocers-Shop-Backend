@extends('admin.layouts.index')
@section('title','Page Create')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            {!! Form::open([ 'method'=>'POST', 'route' => ['admin.cms.update',$cms->id], 'files' => true , 'class' => 'custom-validation']) !!}
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
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#page" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Page</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#content" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Content</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#seo" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SEO</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="page" role="tabpanel">
                                <div class="p-20">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Page Name</label>
                                                <input id="pageName" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $cms->name }}" required autocomplete="name" autofocus>
                                                <label for="slug">http://www.grocerbd.com/
                                                    <input id="permalink" name="slug" value="{{ $cms->slug }}" type="text" autofocus="off" autocomplete="off" class="permalink">
                                                </label>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name_bn">Page Name (Bangla)</label>
                                                <input id="name_bn" type="text" class="form-control @error('name_bn') is-invalid @enderror" name="name_bn" value="{{ $cms->name_bn }}" required autocomplete="name_bn" autofocus>

                                                @error('name_bn')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="visibility">Visibility</label>
                                                <select class="form-control valid" id="parentId" name="visibility" aria-required="true" aria-describedby="visibility" aria-invalid="false">
                                                    <option value="1" selected="selected">Public</option>
                                                    <option value="0" disabled="disabled">Private</option>
                                                </select>

                                                @error('visibility')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control valid" id="parentId" name="status" aria-required="true" aria-describedby="status" aria-invalid="false">
                                                    <option value="0" @if($cms->status === 0) selected @endif>Draft</option>
                                                    <option value="1" @if($cms->status === 1) selected @endif>Publish</option>
                                                </select>

                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="content" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="content">Page Content</label>
                                            <textarea class="textarea_editor form-control @error('content') is-invalid @enderror" name="content" rows="15" placeholder="Enter text ...">{!! $cms->content !!}</textarea>

                                            @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="content_bn">Page Content (Bangla)</label>
                                            <textarea class="textarea_editor form-control @error('content_bn') is-invalid @enderror" name="content_bn" rows="15" placeholder="Enter text ...">{!! $cms->content_bn !!}</textarea>

                                            @error('content_bn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane p-20" id="seo" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input id="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ $cms->meta_title }}" autocomplete="meta_title" autofocus>

                                            @error('meta_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title_bn">Meta Title (Bangla)</label>
                                            <input id="meta_title_bn" type="text" class="form-control @error('meta_title_bn') is-invalid @enderror" name="meta_title_bn" value="{{ $cms->meta_title_bn }}" autocomplete="meta_title_bn" autofocus>

                                            @error('meta_title_bn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group"> 
                                        @if($cms->meta_tags !== null)
                                            @foreach(json_decode($cms->meta_tags) as $key => $meta_tags)
                                            <span class="tm-tag" id="pre_tag{{ str_replace('=','0',base64_encode($key+1)).$key }}">{{ $meta_tags }}<a href="javascript:;" onclick="deleteTags('pre_tag{{ str_replace('=','0',base64_encode($key+1)).$key }}')" class="tm-tag-remove" tagidtoremove="1"><i class="ti-close"></i></a></span>
                                            @endforeach
                                        @endif
                                            <label for="meta_tags">Meta Tags</label></br>
                                            <input type="hidden" id="pre_meta_tags" name="pre_meta_tags" value="{{ $cms->meta_tags !== null ? implode(',',json_decode($cms->meta_tags)) : '' }}">
                                            <input id="meta_tags" type="meta_tags" class="form-control @error('hidden_meta_tags') is-invalid @enderror" name="meta_tags" value="" autocomplete="meta_tags" autofocus>
                                        
                                            @error('hidden_meta_tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea class="textarea_editor form-control @error('meta_description') is-invalid @enderror" name="meta_description" rows="15" placeholder="Enter text ...">{{ old('meta_description') }}</textarea>

                                            @error('meta_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
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
                            {{ __('save') }}
                        </button>
                        </a>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div> <!-- end row -->
    </div>
</div>  
<script>
    $(document).ready(function() {
        $('#pageName').on('keyup', function() {
           // alert($('#pageName').val());   
            $('#permalink').val(strToSlug($('#pageName').val()));
        })
    })
</script>
@endsection