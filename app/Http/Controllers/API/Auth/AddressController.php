<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressStoreCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Address;

class AddressController extends Controller
{
    public function store(Request $request, Address $address) {  
        $address->user_id = $request->user_id;
        $address->name = $request->name;
        $address->mobile_number = $request->mobile_number;
        $address->area = $request->area;
        $address->address = $request->address;
        $address->area_bn = $request->area;
        $address->is_default = 0;

        if($address->save()) {
            return new AddressStoreCollection($address->where('user_id',Auth::guard('api')->user()->getKey())->get());
        }
    }

    public function index() { 
        if(Auth::guard('api')->check()){
            $addressCollection = Address::where('user_id', Auth::guard('api')->user()->getKey())->get();
            return new AddressCollection($addressCollection);
        } else {
            return response()->json(['user'=>'User is not authenticated!']);
        }
    }

    public function delete(Request $request) { 
        if(Auth::guard('api')->check()){
            $address = Address::destroy($request->address_id);
            if($address){
                return response()->json(['type'=>'success','message'=>'Address deleted successfully.']);
            } else {
                return response()->json(['type'=>'warning','message'=>'Address did not deleted.'], 422);
            }            
        } else {
            return response()->json(['type'=>'danger','message'=>'Something is happening wrong. Please loading and try againg.'], 422);
        }
    }

    public function defaultAddress(Request $request) {
        Address::where('user_id', Auth::guard('api')->user()->getKey())
               ->where('id',$request->address_id)
               ->update(['is_default'=>1]);

        Address::where('user_id', Auth::guard('api')->user()->getKey())
                ->whereNotIn('id', [$request->address_id])
                ->update(['is_default'=>0]);
        
        return new AddressCollection(Address::where('user_id', Auth::guard('api')->user()->getKey())->get());
    }

    public function edit(Request $request) {  
     
        $address = Address::where('user_id', Auth::guard('api')->user()->getKey())
                ->where('id', $request->address_id)
                ->update([
                    'user_id' => $request->user_id,
                    'name' =>$request->name,
                    'mobile_number' => $request->mobile_number,
                    'area' => $request->area,
                    'address' => $request->address,
                    'area_bn' => $request->area,
                    'is_default' => $request->is_default
                ]);
                
        if($address) {
            return new AddressCollection(Address::where('user_id',Auth::guard('api')->user()->getKey())->get());
        }
    }
}
