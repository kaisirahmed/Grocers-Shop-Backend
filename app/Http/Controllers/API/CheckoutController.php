<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Order;
use App\Stock;
use App\ProductOrder;
use Cart;
use App\Address;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    { 
        $cartCollection = Cart::session(Auth::guard('api')->user()->getKey())->getContent(); 
        $input = array();
        $input['user_id'] = Auth::guard('api')->user()->getKey();
        $address = Address::where('user_id', Auth::guard('api')->user()->getKey())->where('is_default',1)->first();
        $input['address_id'] = $address->id;
        $input['payment_method'] = $request->payment_method;
        $input['total_price'] = Cart::session(Auth::guard('api')->user()->getKey())->getTotal();
        $input['delivery_charge'] = $request->delivery_cost;
        
        $input['order_status'] = 'Processing';
        $input['payment_status'] = "Unpaid";
        
        $input['order_date'] = date("Y-m-d H:i:s");
        $input['delivery_date'] = date('Y-m-d', strtotime("+7 day", strtotime($input['order_date'])));
        $orderId = Order::insertGetId($input);
        $order_number   =   date("y").str_pad($orderId, 4, 0, STR_PAD_LEFT).date("d");
        
        Order::where('id',$orderId)
                ->update(['order_number'=>$order_number,'invoice_number'=>$order_number]);                
        
        foreach($cartCollection as $cart) { 
            if(Stock::where('product_id',$cart->id)->exists()) {
                $stocks = Stock::where('product_id',$cart->id)->first();  
                $stock['product_id'] = $cart->id;
                $stock['quantity'] = $stocks->quantity - $cart->quantity;
                $stock['unit_id'] = $cart->attributes->unit_id;
                $stock['selling_quantity'] = $stocks->selling_quantity + $cart->quantity;
                $stock['total_quantity'] = $stocks->total_quantity + $cart->quantity;
                Stock::where('id',$stocks->id)->update($stock);
            } else {
                $stock['product_id'] = $cart->id;
                $stock['quantity'] = 0 - $cart->quantity;
                $stock['selling_quantity'] = 0 + $cart->quantity;
                $stock['unit_id'] = $cart->attributes->unit_id;
                $stock['total_quantity'] = 0 + $cart->quantity;
                Stock::create($stock);
            }

            $orderData['order_id'] = $orderId;
            $orderData['product_id'] = $cart->id;
            $orderData['product_name'] = $cart->attributes->name;
            $orderData['quantity'] = $cart->quantity;
            $orderData['product_price'] = $cart->price;
            $orderData['unit_id'] = $cart->attributes->unit_id;
            $orderData['image'] = $cart->attributes->image;
            $orderData['image_type'] = $cart->attributes->image_type;
            $orderData['price'] = $cart->price;

            $productOrder = ProductOrder::create($orderData);
        }
        
        Cart::session(Auth::guard('api')->user()->getKey())->clear();
        
        return response()->json(['success'=>true,'message'=>'Order placed successfully.']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
