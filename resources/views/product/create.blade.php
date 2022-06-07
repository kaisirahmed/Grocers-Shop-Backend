@extends('admin.layouts.index')
@section('title','Product')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            {!! Form::open([ 'method'=>'POST', 'route' => ['product.store'], 'files' => true , 'class' => 'custom-validation']) !!}
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:;" class="float-right">
                                <button id="reset" type="reset" class="btn btn-warning">
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
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#productinfo" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Product info</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#description" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Description</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#offers" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Offers</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#seo" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SEO</span></a> </li>
                                </ul> 
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane p-20 active" id="productinfo" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label for="name_bn">Name (Bangla)</label>
                                                    <input id="name_bn" type="text" class="form-control @error('name_bn') is-invalid @enderror" name="name_bn" value="{{ old('name_bn') }}" required autocomplete="name_bn" autofocus>

                                                    @error('name_bn')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="sub_name">Sub Name</label>
                                                    <input id="sub_name" type="text" class="form-control @error('sub_name') is-invalid @enderror" name="sub_name" value="{{ old('sub_name') }}" autocomplete="sub_name" autofocus>

                                                    @error('sub_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="sub_name_bn">Sub Name (Bangla)</label>
                                                    <input id="sub_name_bn" type="text" class="form-control @error('sub_name_bn') is-invalid @enderror" name="sub_name_bn" value="{{ old('sub_name_bn') }}" autocomplete="sub_name_bn" autofocus>

                                                    @error('sub_name_bn')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="site_name">Category</label>
                                                    
                                                    <select class="multiSelection js-states form-control" name="category_id[]" multiple="multiple">
                                                        <option value="" disabled>Please Select</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) ? 'selected' : '' @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('category_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" min="1" value="" required autocomplete="price" autofocus>

                                                    @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="image">Product Image <i title="Image for product" class="ti-help-alt"></i></label>
                                                    <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="productImage">
                                                        <label class="custom-file-label" id="imageChoose" for="inputGroupFile01">Choose file</label>
                                                    </div>
                                                    </div>

                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" min="1" value="{{ old('quantity') }}" required autocomplete="quantity" autofocus>

                                                    @error('quantity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="unit">Unit</label>
                                                    
                                                    <select class="multiSelection js-states form-control" name="unit_id">
                                                        <option value="" selected disabled>Please select</option>
                                                        @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}" @if(old('unit_id')) selected @endif>{{ $unit->short_format }}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    @error('unit_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    
                                                    <select class="multiSelection js-states form-control" name="status">
                                                        <option value="" selected>Please select</option>
                                                        <option value="1" @if(old('status') == '1') selected @endif>Publish</option>
                                                        <option value="0" @if(old('status') == '0') selected @endif>Unpublish</option>
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
                                    <div class="tab-pane p-20" id="description" role="tabpanel">
                                        <div class="form-group">
                                            <label for="description">Product Description</label>
                                            <textarea class="textarea_editor form-control @error('description') is-invalid @enderror" name="description" rows="15" placeholder="Enter text ...">{{ old('description') }}</textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                    
                                    </div>
                                    <div class="tab-pane p-20" id="offers" role="tabpanel">
                                        <div class="row">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label for="discount">Manual Discount</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input class="@error('discount_amount') is-invalid @enderror" id="manualDiscount" type="radio" name="discount" aria-label="radio for following text input">
                                                            </div>
                                                        </div>
                                                        <input type="text" disabled="disabled" class="form-control" value="Manual Discount" aria-label="Text input with radio">
                                                    </div>

                                                    @error('discount_amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    
                                                </div>

                                                <div class="discountA">
                                                
                                                </div>

                                                <div class="form-group" id="DP">
                                                    <label for="discount">Discount Percentage</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input class="@error('discount_percentage') is-invalid @enderror" id="manualPercentage" type="radio" name="discount" aria-label="radio for following text input">
                                                            </div>
                                                        </div>
                                                        <input type="text" disabled="disabled" class="form-control" value="Discount Percentage" aria-label="Text input with radio">
                                                    </div>

                                                    @error('discount_percentage')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="discountP">
                                                
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label for="sale_price">Sale Price</label>
                                                    <input id="salePrice" type="number" class="form-control @error('sale_price') is-invalid @enderror" min="1" name="sale_price" min="1" value="" required autocomplete="sale_price" readonly autofocus>

                                                    @error('sale_price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="special_offer">Special Offer</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input class="@error('special_image') is-invalid @enderror" id="specialOffer" name="special_offer" type="checkbox"  aria-label="Checkbox for following text input"  @if(old('special_offer')) checked @endif>
                                                            </div>
                                                        </div>
                                                        <input type="text" disabled="disabled" class="form-control" value="Special Offer" aria-label="Text input with checkbox">
                                                    </div>
                                                    
                                                    @error('special_image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                                <div id="isSpecialOffer">
                                                
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane p-20" id="seo" role="tabpanel">

                                        <div class="row">

                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title</label>
                                                    <input id="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title') }}" autocomplete="meta_title" autofocus>

                                                    @error('meta_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                
                                                <div class="form-group">
                                                    <label for="meta_tags">Meta Tags</label></br>
                                                    <input id="meta_tags" type="text" class="form-control @error('hidden_meta_tags') is-invalid @enderror" name="meta_tags" value="" autocomplete="meta_tags" autofocus>

                                                    @error('hidden_meta_tags')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-lg-12">
                                                
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
                                <button id="reset1" type="reset" class="btn btn-warning">
                                    {{ __('Reset') }}
                                </button>
                                <button type="submit" class="btn btn-info">
                                    {{ __('Save') }}
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    
                {{ Form::close() }}
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
<script>

$(document).ready(function() {

    if($("#specialOffer").prop("checked") == true){ 
        $('#isSpecialOffer').append('<div class="form-group" id="specialImage"><label for="specialImage">Product Special Image <i title="Special Image for product" class="ti-help-alt"></i></label><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text">Upload</span></div><div class="custom-file"><input type="file" id="specialOfferImage" class="custom-file-input" name="special_image"><label class="custom-file-label" for="inputGroupFile01" id="specialImageChoose">Choose file</label></div></div></div>');
    }

    $("#specialOffer").change(function() { 
        if($(this).prop("checked") == true){ 
            $('#isSpecialOffer').append('<div class="form-group" id="specialImage"><label for="specialImage">Product Special Image <i title="Special Image for product" class="ti-help-alt"></i></label><div class="input-group mb-4"><div class="input-group-prepend"><span class="input-group-text">Upload</span></div><div class="custom-file"><input type="file" id="specialOfferImage" class="custom-file-input" name="special_image"><label class="custom-file-label" for="inputGroupFile01" id="specialImageChoose">Choose file</label></div></div></div>');
        } else if($(this).prop("checked") == false){
            $('#specialImage').remove();
        }
    });

    $(document).on("change", '#specialOfferImage', function () {
        var filename = $(this)[0].value.split("\\").pop();
        if ($(this).val() == "") {
            $('#specialImageChoose').text('Choose file');
        }else{
            $('#specialImageChoose').text(filename);
        }
    });
 
    $('#price').on('keyup', function() {
        var price = $(this).val();
        $('form .checkPrice').remove();
            var discountAmount = $('form #inputDiscountAmount').val();
            var discountPercent = $('form #inputDiscountPercentage').val();
            if(discountAmount) { 
                var salePrice = price - discountAmount; 
                $('form #salePrice').val(salePrice);
            } else if(discountPercent) {
                var discountAmount = price*(discountPercent/100);
                var salePrice = price - discountAmount;
                $('form #salePrice').val(salePrice);
            } else {
                $('form #salePrice').val(price);
            }        
    })

    if($("#manualDiscount").prop("checked") == true) {
        
        $('#discountPercentage').remove();
        $('.discountA').append('<div class="form-group" id="discountAmount"><label for="discount">Discount Amount</label><input id="inputDiscountAmount" type="number" class="form-control" name="discount_amount" min="1" value="" autocomplete="discount" autofocus><div class="checkPrice"><div></div>');
        
        $(document).on("keyup", "#inputDiscountAmount" , function() {
            var discountAmount = $(this).val();
            var price = $("#price").val();
            if(price) {
                $('form .checkPrice').remove();
                var salePrice = price - discountAmount;
                $('form #salePrice').val(salePrice);
            } else {
                $('form .checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
            }
        });
    }

    $("#manualDiscount").change(function() {
        
        if($(this).prop("checked") == true) {
            $('#discountPercentage').remove();
            $('.discountA').append('<div class="form-group" id="discountAmount"><label for="discount">Discount Amount</label><input id="inputDiscountAmount" type="number" class="form-control" name="discount_percentage" min="1" value="" autocomplete="discount" autofocus><div class="checkPrice"><div></div>');
            
            $(document).on("keyup", "#inputDiscountAmount" , function() {
                var discountAmount = $(this).val();
                var price = $("#price").val(); 
                if(price) {
                    $('form .checkPrice').remove();
                    var salePrice = price - discountAmount;
                    $('form #salePrice').val(salePrice);
                } else {
                    $('form .checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
                }
                
            });
        }
    })

    $('#reset, #reset1').on('click', function() {
        $('#discountAmount').remove();
        $('#discountPercentage').remove();
        $('#specialImage').remove();
    })

    if($("#manualPercentage").prop("checked") == true) {
        $('#discountAmount').remove();
        $('.discountP').append('<div class="form-group" id="discountPercentage"><label for="discount_percentage">Discount Percentage</label><input id="inputDiscountPercentage" type="number" class="form-control" name="discount_percentage" min="1" value="" autocomplete="discount_percentage" autofocus><div class="checkPrice"><div></div>');

        $(document).on("keyup", "#inputDiscountPercentage" , function() {
            var discountPercent = $(this).val();
            var price = $("#price").val();
            if(price) {
                $('form .checkPrice').remove();
                var discountAmount = price*(discountPercent/100);
                var salePrice = price - discountAmount;
                $('form #salePrice').val(salePrice);
            } else {
                $('form .checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
            }
        });
    }

    $("#manualPercentage").change(function() {
     
        if($(this).prop("checked") == true) {
            $('#discountAmount').remove();
            $('#DP').append('<div class="form-group" id="discountPercentage"><label for="discount_percentage">Discount Percentage</label><input id="inputDiscountPercentage" type="number" class="form-control" name="discount_percentage" min="1" value="" autocomplete="discount_percentage" autofocus><div class="checkPrice"><div></div>');

            $(document).on("keyup", "#inputDiscountPercentage" , function() {
                var discountPercent = $(this).val();
                var price = $("#price").val();
                if(price) {
                    $('form .checkPrice').remove();
                    var discountAmount = price*(discountPercent/100);
                    var salePrice = price - discountAmount;
                    $('form #salePrice').val(salePrice);
                } else {
                    $('form .checkPrice').html('<span class="invalid-feedback" role="alert">Please set the price before.</span>');
                }
            });
        }
    });

    $('#productImage').change(function () {
        var filename = $(this)[0].value.split("\\").pop();
        if ($(this).val() == "") {
            $('#imageChoose').text('Choose file');
        }else{
            $('#imageChoose').text(filename);
        }
    });
 
});

   
</script>
@endsection