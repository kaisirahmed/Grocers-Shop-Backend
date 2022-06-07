@extends('admin.layouts.index')
@section('title','View Single Product')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#product" role="tab"><span class="hidden-sm-up"><i class="ti-info-alt"></i></span> <span class="hidden-xs-down">Product Info</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#description" role="tab"><span class="hidden-sm-up"><i class="ti-tag"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#offers" role="tab"><span class="hidden-sm-up"><i class="ti-image"></i></span> <span class="hidden-xs-down">Offers</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#seo" role="tab"><span class="hidden-sm-up"><i class="ti-image"></i></span> <span class="hidden-xs-down">SEO</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="product" role="tabpanel">
                                <div class="row">

                                    <div class="p-20 col-md-12">
                                        <table class="display responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                           
                                            <tbody>
                                                <tr> 
                                                    <th>Name</th>
                                                    <td>{{ $product->name.' '.$product->sub_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Name (Bangla)</th>
                                                    <td>
                                                    {{ $product->name_bn.' '.$product->sub_name_bn }}
                                                    </td>
                                                </tr>
                                                  
                                                <tr>
                                                    <th>Image</th>
                                                    <td><img width="250px" class="tm-tag" src="{{ 'data:image/' . $product->image_type . ';base64,' . $product->image }}" alt="{{ $product->name }}"></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <th>Unit</th>
                                                    <td>
                                                        @if($product->unit->short_format == "each")
                                                            {{ $product->unit->short_format }}
                                                        @else
                                                            {{ $product->quantity.' '.$product->unit->short_format }}
                                                        @endif
                                                    </td>
                                                </tr> 
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        <span class="badge badge-{{ $product->status === 1 ? 'success' : 'warning' }}">{{ $product->status === 1 ? 'Published' : 'Draft' }}</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane p-20" id="description" role="tabpanel">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane p-20" id="offers" role="tabpanel">
                                <table class="display responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                           
                                    <tbody>
                                        <tr>
                                            <th>Price</th>
                                            <td><p class="tm-tag">{{ floatval($product->price) }} &#2547; </p></td>
                                        </tr>
                                        <tr>
                                            @if($product->discount_amount != null)
                                                <th>Discount</th>
                                                <td><p class="tm-tag">{{ floatval($product->discount_amount) }}  &#2547;</p> </td>
                                            @endif
                                            @if($product->discount_percentage != null)
                                                <th>Discount</th>
                                                <td><p class="tm-tag">{{ floatval($product->discount_percentage) }}  &#37;</p> </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Sale Price</th>
                                            <td><p class="tm-tag">{{ floatval($product->sale_price) }} &#2547; </p></td>
                                        </tr> 
                                        @if($product->special_offer == 'on')
                                        <tr>
                                            <th>Special Offer</th>
                                            <td>{{ __('Yes') }}</td>
                                        </tr>   

                                        <tr>
                                            <th>Special Image</th>
                                            <td><img width="250px" class="tm-tag" src="{{ 'data:image/' . $product->special_image_type . ';base64,' . $product->special_image }}" alt="{{ $product->name }}"></td>
                                            
                                        </tr>
                                        @else
                                        <tr>
                                            <th>Special Offer</th>
                                            <td><p class="tm-tag-invalid">None</p></td>
                                        </tr> 
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane p-20" id="seo" role="tabpanel">
                                <table class="display responsive nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <tbody>           
                                        <tr>
                                            <th>Meta Title</th>
                                            <td>{!! $product->meta_title !== null ? $product->meta_title : '<p class="tm-tag-invalid">No Title</p>' !!}</td>
                                        </tr>   
                                        
                                        <tr>
                                            <th>Meta Tags</th>
                                            <td>
                                            @if($product->meta_tags !== null)
                                                @foreach(json_decode($product->meta_tags) as $meta_tags)
                                                    <p class="tm-tag-invalid">{{ $meta_tags }}</p>
                                                @endforeach
                                            @else
                                                <p class="tm-tag-invalid">No Tags to show</p>
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Meta Description</th>
                                            <td>{!! $product->meta_description !== null ? $product->meta_description : '<p class="tm-tag-invalid">No Description</p>' !!}</td>
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