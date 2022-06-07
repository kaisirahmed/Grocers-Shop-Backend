@extends('admin.layouts.index')
@section('title', 'Product List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('product.create') }}" class="btn btn-primary float-right">
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
                    <div class="col-md-12">

                        <table class="table" cellspacing="0">
                            <tr>
                                <td colspan="4"><span class="float-left">All ({{ count($products) }}) | Published ({{ count($products->where('status',1)) }}) | Drafts ({{ count($products->where('status',0)) }})</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td width="8%">
                                    <button type="button" id="productDelete" class="btn btn-danger"><i class="ti-trash"></i> Delete</button>
                                </td>
                                <td width="25%">
                                    <select class="form-control" id="categoryName" name="category_id">
                                        <option value="">Filter by Category (All)</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name.' '.'('.$category->products()->count().')' }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td width="30%" colspan="2">
                                    <select class="form-control" id="stockStatus" name="category_id">
                                        <option value="">Filter by Stock status (All)</option>
                                        <option value="In Stock">In Stock</option>
                                        <option value="Low Stock">Low Stock</option>
                                        <option value="Out Of Stock">Out of Stock</option>
                                    </select>
                                </td>
                                <td></td>
                            </tr>

                        </table>       
                    
                    </div>
                    <table id="datatableProduct" class="display dt-responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Name (Bangla)</th>
                                <th>Categories</th>
                                <th>Price (&#2547;)</th>
                                <th>Sale Price (&#2547;)</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Name (Bangla)</th>
                                <th>Categories</th>
                                <th>Price (&#2547;)</th>
                                <th>Sale Price (&#2547;)</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($products as $product)
                            <tr> 
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    <img width="50px" src="{{ 'data:image/' . $product->image_type . ';base64,' . $product->image }}" alt="{{ $product->image }}">
                                </td>
                                <td>{{ $product->name.' '.$product->sub_name }}</td>
                                <td>{{ $product->name_bn.' '.$product->sub_name_bn }}</td>
                                <td>{{ implode(', ', $product->categories()->get()->sortBy('name')->pluck('name')->toArray()) }}</td>
                                <td>&#2547; {{ floatval($product->price) }}</td>
                                <td>&#2547; {{ floatval($product->sale_price) }}</td>
                                <td>
                                @if($product->unit->short_format == "each")
                                    {{ $product->unit->short_format }}
                                @else
                                    {{ $product->quantity.' '.$product->unit->short_format }}
                                @endif
                                </td>
                                <td> 
                                    @if(\App\Stock::where('product_id',$product->id)->where('quantity','>',10)->exists())
                                    <span class="badge badge-success">In Stock</span>
                                    @elseif(\App\Stock::where('product_id',$product->id)->where('quantity','<',10)->where('quantity','>',4)->exists())
                                    <span class="badge badge-warning">Low Stock</span>
                                    @else
                                    <span class="badge badge-danger">Out Of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $product->status === 1 ? 'success' : 'warning' }}">{{ $product->status === 1 ? 'Published' : 'Draft' }}</span></td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="ti-pencil-alt text-warning"></i></button>
                                    </a>

                                    <a href="{{ route('product.show', $product->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class="ti-eye text-info"></i></button>
                                    </a>

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $product->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
                                    <form id="delete{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <a style="display:hidden" id="routePdf" href="{{ route('products.pdf') }}"></a>
                                    <a style="display:hidden" id="productDeleteRoute" href="{{ route('products.delete') }}"></a>
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
