@extends('admin.layouts.index')
@section('title', 'Category List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('category.create') }}" class="btn btn-primary float-right">
                    {{ __('Add New') }}
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

                <div class="m-t-40">
                    <table id="datatable" class="display dt-responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Name (Bangla)</th>
                                <th>Sub Categories</th>
                                <th>Tags</th>
                                <th>Order No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th></th>
                                <th>Name</th>
                                <th>Name (Bangla)</th>
                                <th>Sub Categories</th>
                                <th>Tags</th>
                                <th>Order No</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($categories as $category)
                            <tr> 
                                <td></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->name_bn }}</td>
                                <td>
                                    @if(count($category->subcategory()->get()) > 0)
                                    {{ implode(', ', $category->subcategory()->get()->pluck('name')->toArray()) }}
                                    @else
                                    <i class="ti-help-alt" title="No sub category to show"></i> 
                                    @endif
                                </td>
                                <td>
                                    @if(count(json_decode($category->tags)) > 0)
                                        @foreach(json_decode($category->tags) as $tags)
                                            <p class="tm-tag">{{ $tags }}</p>
                                            @if($loop->iteration > 2)
                                                ...
                                                @break
                                            @endif
                                        @endforeach 
                                        
                                    @else
                                        <p class="tm-tag">No Tags to show</p>
                                    @endif
                                </td>
                                <td>{{ $category->order_no }}</td>
                                <td>
                                    <span class="badge badge-{{ $category->status === 1 ? 'success' : 'warning' }}">{{ $category->status === 1 ? 'Active' : 'Inactive' }}</span></td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
                                    </a>

                                    <a href="{{ route('category.show', $category->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="ti-eye text-info"></i></button>
                                    </a>

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $category->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
                                    <form id="delete{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <a style="display:hidden" id="routePdf" href="{{ route('categories.pdf') }}"></a>
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
