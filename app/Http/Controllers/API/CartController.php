<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CartCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\Product;

class CartController extends Controller
{
    public function addToCart(Request $request) {
       
        $product = Product::find($request->product_id);
        
        if($product) {
                         
            Cart::session(Auth::guard('api')->user()->getKey())->add(array(
                'id'=>$product->id,
                'name'=>$product->name,
                'price'=>$product->price,
                'quantity'=>$request->quantity,
                'attributes'=>array(
                    'id'=>$product->id,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'name_bn' => $product->name_bn,
                    'sub_name' => $product->sub_name,
                    'sub_name_bn' => $product->sub_name_bn,
                    'slug' => $product->slug,
                    'price_bn' => $product->price_bn,
                    'sale_price' => $product->sale_price,
                    'sale_price_bn' => $product->sale_price_bn,
                    'image' => $product->image,
                    'image_type' => $product->image_type,
                    'unit_id' => $product->unit_id,
                )
            ));

            return response()->json(['success' => true, 'message' => 'Product is addedd to the cart successfully.']);
        }
    }

    public function getCart(Request $request) { 
        $cartProductCollection = array();
        
        if (Auth::guard('api')->check()) {
           
            $cartCollection = Cart::session(Auth::guard('api')->user()->getKey())->getContent(); 
        
            foreach($cartCollection as $cartItems) {

                $attributes = $cartItems["attributes"];
                $quantity = $cartItems->quantity;
     
                //$newCart = $this->array_except($cartItems, ['attributes','quantity']);  
                //$collection = array_merge($newCart, $attributes);
                
                $cartProductCollection[] = [
                    'product' => $attributes,
                    'quantity' => $quantity
                ];
            } 
           
            return new CartCollection($cartProductCollection);
        } else {
            return new CartCollection($cartProductCollection);
        }
    }

    // public function getCart() {  

    //     $cartCollection = Cart::getContent()->toArray(); 
    //     $cartProductCollection = [];

    //     foreach($cartCollection as $key => $cartItems) {

    //         $attributes = $cartItems['attributes'];
    //         $quantity = $cartItems['quantity'];

    //         $newCart = $this->array_except($cartItems, ['attributes','quantity']);
    //         $collection = array_merge($newCart, $attributes);
            
    //         $cartProductCollection[] = [
    //             'product' => $collection,
    //             'quantity' => $quantity
    //         ];
    //     }
    //     return new CartCollection($cartProductCollection);
    // }


    // public function onCartDataUpdate(Request $request)
    // { 
        
    //     $products = array(Session::get('carts'));
    //     $carts = array_push($products, $request->product_id);
        
    //     Session::put('carts', $carts);
    //     $product = Session::get('carts');
    //     return $product;

    //     $returnArr = [];
    //     $productArr = [];
    //     $data = post();
    //     foreach ($data as $values):
    //         $returnArr[] = base64_decode($values);
    //     endforeach;
    //     $count = array_count_values($returnArr);
    //     $query = Product::whereIn('id', $returnArr)->get();

    //     foreach ($query as $product):
    //         $productArr[] = array(
    //             'id'=>$id,
    //             'name'=>$name,
    //             'price'=>$price,
    //             'quantity'=>$quantity,
    //             'name_bn' => $product->name_bn,
    //             'sub_name' => $product->sub_name,
    //             'sub_name_bn' => $product->sub_name_bn,
    //             'slug' => $product->slug,
    //             'price_bn' => $product->price_bn,
    //             'sale_price' => $product->sale_price,
    //             'sale_price_bn' => $product->sale_price_bn,
    //             'image' => $product->image,
    //             'image_type' => $product->image_type,
    //         );
    //     endforeach;

    //     return [
    //         // $query,
    //         "-",
    //         $count,
    //         $productArr,
    //     ];
    // }

    public function array_except($array, $keys){
        foreach($keys as $key){ 
            unset($array[$key]);
        } 
        return $array; 
    }

    public function cartUpdate(Request $request) {  
        // you may also want to update a product's quantity
        $cart = Cart::session(Auth::guard('api')->user()->getKey())->update($request->cart_id, array(
            'quantity' => $request->quantity, 
        ));

        if($cart) {
            return response()->json(['type'=>'success','message'=>'Cart has been updated successfully.']);
        }
    }

    public function delete($id) {
        Cart::session(Auth::guard('api')->user()->getKey())->remove($id);
        return response()->json(['success'=>true,'message'=>'Cart product removed successfully.']);
    }

    public function destroy() {
        //Cart::clear();
        Cart::session(Auth::guard('api')->user()->getKey())->clear();
        return response()->json(['success'=>true,'message'=>'Cart has been cleared successfully.']);
    }
}

