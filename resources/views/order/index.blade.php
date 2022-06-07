@extends('admin.layouts.index')
@section('title', 'Order List')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('order.create') }}" class="btn btn-primary float-right">
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
                                <th>Customer Name</th>
                                <th>Order Number</th>
                                <th>Order Status</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Delivery Charge</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Customer Name</th>
                                <th>Order Number</th>
                                <th>Order Status</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Delivery Charge</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $order)
                            <tr> 
                                <td></td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ date("F d, Y",strtotime($order->order_date)) }}</td>
                                <td>{{ date("F d, Y",strtotime($order->delivery_date)) }}</td>
                                <td>{{ $order->delivery_charge }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $order->payment_status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('order.show', $order->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="View" data-original-title="view"><i class="ti-eye text-warning"></i></button>
                                    </a> |

                                    <a target="_blank" href="{{ route('order.invoice', $order->id) }}">
                                        <button class="grocers-btn" data-toggle="tooltip" data-placement="top" title="Invoice" data-original-title="invoice"><i class="ti-eye text-info"></i></button>
                                    </a>

                                    <button class="grocers-btn" type="submit" onclick="confirmDelete('{{ $order->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="ti-trash text-danger"></i></button>
                                
                                    <form id="delete{{ $order->id }}" action="{{ route('order.destroy', $order->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                    <a style="display:hidden" id="routePdf" href=""></a>
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
