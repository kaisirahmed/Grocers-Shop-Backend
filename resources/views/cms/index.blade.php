@extends('admin.layouts.index')
@section('title', 'All pages')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.cms.create') }}" class="btn btn-primary float-right">
                    {{ __('Add New Page') }}
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

                @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>{!! session('warning') !!}</strong>
                    </div>
                @endif

                <div class="m-t-40">
                    <table id="datatable" class="display dt-responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Page Name</th>
                                <th>Page Name (Bangla)</th>
                                <th>Visibility</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Page Name</th>
                                <th>Page Name (Bangla)</th>
                                <th>Visibility</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($cms as $page)
                            <tr> 
                                <td></td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->name_bn }}</td>
                                <td>
                                    <span class="badge badge-{{ $page->visibility === 1 ? 'success' : 'warning' }}">{{ $page->visibility === 1 ? 'Public' : 'Private' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $page->status === 1 ? 'success' : 'warning' }}">{{ $page->status === 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.cms.edit', $page->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
                                    </a>

                                    <a href="{{ route('admin.cms.show', $page->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="ti-eye text-info"></i></button>
                                    </a>

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $page->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
                                    <form id="delete{{ $page->id }}" action="{{ route('admin.cms.destroy', $page->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <a style="display:hidden" id="routePdf" href="{{ route('admin.cms.pages.pdf') }}"></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
