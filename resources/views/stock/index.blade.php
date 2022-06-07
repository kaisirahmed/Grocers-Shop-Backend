@extends('admin.layouts.index')
@section('title', 'Stock List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('stock.create') }}" class="btn btn-primary float-right">
                    <i class="ti-plus"></i> {{ __('Add New') }}
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
                                <th>Product Name</th>
                                <th>Current Quantity</th>
                                <th>Selling Quantity</th>
                                <th>Total Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th>Current Quantity</th>
                                <th>Selling Quantity</th>
                                <th>Total Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($stocks as $stock)
                            <tr> 
                                <td></td>
                                <td>{{ $stock->product->name.' '.$stock->product->sub_name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{!! $stock->selling_quantity !== null ? $stock->selling_quantity : '<p class="tm-tag-invalid">None</p>' !!}</td>
                                <td>{{ $stock->total_quantity }}</td>
                                <td>
                                    @if($stock->quantity > 10)
                                    <span class="badge badge-success">In Stock</span>
                                    @elseif($stock->quantity > 4 && $stock->quantity < 10)
                                    <span class="badge badge-warning">Low Stock</span>
                                    @else
                                    <span class="badge badge-danger">Out Of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('stock.edit', $stock->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
                                    </a>

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $stock->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
                                    <form id="delete{{ $stock->id }}" action="{{ route('stock.destroy', $stock->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <a style="display:hidden" id="routePdf" href="{{ route('stocks.pdf') }}"></a>
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
