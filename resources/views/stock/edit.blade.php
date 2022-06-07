@extends('admin.layouts.index')
@section('title','Add Edit Stock')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            {!! Form::open([ 'method'=>'PATCH', 'route' => ['stock.update',$stock], 'files' => true , 'class' => 'custom-validation']) !!}
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

                        <div class="row">
                        
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="product_id">Products</label>
                                    <select class="form-control valid multiSelection js-states" name="product_id" id="productId" aria-required="true" aria-describedby="product_id" aria-invalid="false" readonly>
                                        <option value="" selected="selected" disabled>Please Select</option>
                                        <option value="{{ $product->id }}" selected>{{ $product->name.' '.$product->sub_name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="quantity">New Quantity</label>
                                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $stock->quantity }}" required autocomplete="quantity" autofocus>

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    
                                    <select id="unitId" class="multiSelection js-states form-control" name="unit_id" readonly>
                                        <option value="{{ $stock->unit_id }}">{{ $stock->product->unit->short_format }}</option>
                                    </select>
                                    
                                    @error('unit_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        
                        </div>

                    </div>
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
                </div>
            </div> <!-- end col -->
            
        </div> <!-- end row -->
    </div>
</div>  
<script>
    $(document).ready(function() {
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#productId").on('change', function() {
            var product_id = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('stock.product.unit') }}",
                data:{product_id: product_id},
                success: function(data){ 
                    $("#unitId").html('<option value="'+data.unit_id+'" selected readonly>'+data.unit_name+'</option>');
                },
                error:function(exception){
                    alert('Exeption:'+exception);
                }
            });
        });
    })

</script>
@endsection