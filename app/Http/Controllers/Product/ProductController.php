<?php

namespace App\Http\Controllers\Product;

use App\Product;
use App\Category;
use App\Unit;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $products = Product::all();
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
        return view('product.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
  
        return view('product.create',compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    { 
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string','max:100','unique:products,name'],
            'name_bn' => ['required','string','max:100','unique:products,name_bn'],
            'sub_name' => ['nullable','string','max:100'],
            'sub_name_bn' => ['nullable','string','max:100'],
            'price' => ['required',],
            'image' => ['required','image', 'max:512'],//,'dimensions:min_width=200,max_width=250,min_height=250,max_height=250'
            'quantity' => ['required','numeric','min:1'],
            'unit_id' => ['required','integer'],
            'status' => ['required','integer'],
            'discount' => ['nullable','string'],
            'description' => ['required','string'],
            'discount_amount' => ['nullable','integer'],
            'discount_percentage' => ['nullable','integer'],
            'special_offer' => ['nullable','string'],
            'special_image' => ['nullable','image', 'max:512','dimensions:min_width=350,max_width=400,min_height=350,max_height=400'],
            'meta_title' => ['nullable','string'],
            'hidden_meta_tags' => ['nullable','string'],
            'meta_tags' => ['nullable','string'],
            'meta_description' =>['nullable','string'],
        ],
        [
            'hidden_meta_tags.string' => 'Meta tags must be string.'
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
            $product->name = $request->name;
            $product->name_bn = $request->name_bn;
            $product->sub_name = $request->sub_name;
            $product->sub_name_bn = $request->sub_name_bn;
            $product->slug = Str::slug($request->name." ".$request->sub_name);
            $product->slug_bn = Str::slug($request->name_bn." ".$request->sub_name_bn);
            $product->price = $request->price;
            $product->price_bn = convertNumber(floatval($request->price));
            
            if ($request->has('image')) {

                $image = $request->file( 'image' );  
                $imageType = $image->getClientOriginalExtension();
                $imageStr = (string) Image::make( $image )->
                                        resize( 250, 250, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $imageType );

                $product->image = base64_encode( $imageStr );
                $product->image_type = $imageType;
            }
            $product->quantity = $request->quantity;
            $product->unit_id = $request->unit_id;
            $product->status = $request->status;
            $product->description = $request->description;

            if($request->discount == "on") {
                
                if(isset($request->discount_amount)) {
                    $discountAmount = $product->discount_amount = $request->discount_amount;
                    $salePrice = $request->price - $discountAmount;
                    $product->sale_price = $salePrice;
                    $product->sale_price_bn = convertNumber(floatval($salePrice));
                }
                if(isset($request->discount_percentage)) {
                    $discountPercent = $product->discount_percentage = $request->discount_percentage;
                    $discountAmount = $product->price * ($discountPercent / 100);
                    $salePrice = $request->price - $discountAmount;
                    $product->sale_price = $salePrice;
                    $product->sale_price_bn = convertNumber(floatval($salePrice));
                }   
                
            } else {
                $product->sale_price = $request->sale_price;
                $product->sale_price_bn = convertNumber(floatval($request->sale_price));
            }
            
            if(isset($request->special_image) && $request->special_offer == "on") {
                if ($request->has('special_image')) {
                    $product->special_offer = $request->special_offer;
                    $special_image = $request->file( 'special_image' );  
                    $special_imageType = $special_image->getClientOriginalExtension();
                    $special_imageStr = (string) Image::make( $special_image )->
                                            resize( 350, 350, function ( $constraint ) {
                                                $constraint->aspectRatio();
                                            })->encode( $special_imageType );
    
                    $product->special_image = base64_encode( $special_imageStr );
                    $product->special_image_type = $special_imageType;
                }
            } else {
                $product->special_offer = null;
                $product->special_image = null;
                $product->special_image_type = null;
            }

            $product->meta_title = $request->meta_title;
            $product->meta_tags = empty($request->hidden_meta_tags) ? null : json_encode(explode(",",$request->hidden_meta_tags));
            $product->meta_description = $request->meta_description;

            if($product->save()) {
                $product->categories()->attach($request->category_id);
                Session::flash('message','Product has been saved successfully.');
            } else {
                Session::flash('warning','Something is wrong when saving product.');
            }
            return redirect()->route('product.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show',compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $products = Product::all();
        $pdf = PDF::loadView('product.pdf',compact('products'));
        $pdf->SetProtection(['print'], '', 'grocers');
        return $pdf->stream(''."Products".'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $units = Unit::all();
        $categoryId = Category::pluck('parent_id');
        $categories = Category::whereNotIn('id',$categoryId)->get();
        return view('product.edit',compact('product','categories','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string','max:100'],
            'name_bn' => ['required','string','max:100'],
            'sub_name' => ['nullable','string','max:100'],
            'sub_name_bn' => ['nullable','string','max:100'],
            'price' => ['required',],
            'image' => ['nullable','image', 'max:512','dimensions:min_width=200,max_width=250,min_height=250,max_height=250'],
            'quantity' => ['required','numeric','min:1'],
            'unit_id' => ['required','integer'],
            'status' => ['required','integer'],
            'discount' => ['nullable','string'],
            'description' => ['required','string'],
            'discount_amount' => ['nullable','integer'],
            'discount_percentage' => ['nullable','integer'],
            'special_offer' => ['nullable','string'],
            'special_image' => ['nullable','image', 'max:512','dimensions:min_width=350,max_width=400,min_height=350,max_height=400'],
            'meta_title' => ['nullable','string'],
            'hidden_meta_tags' => ['nullable','string'],
            'meta_tags' => ['nullable','string'],
            'meta_description' =>['nullable','string'],
        ],
        [
            'hidden_meta_tags.string' => 'Meta tags must be string.'
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
            $product->name = $request->name;
            $product->name_bn = $request->name_bn;
            $product->sub_name = $request->sub_name;
            $product->sub_name_bn = $request->sub_name_bn;
            $product->slug = Str::slug($request->name." ".$request->sub_name);
            $product->slug_bn = Str::slug($request->name_bn." ".$request->sub_name_bn);
            $product->price = $request->price;
            
            if ($request->has('image')) {

                $image = $request->file( 'image' );  
                $imageType = $image->getClientOriginalExtension();
                $imageStr = (string) Image::make( $image )->
                                        resize( 250, 250, function ( $constraint ) {
                                            $constraint->aspectRatio();
                                        })->encode( $imageType );

                $product->image = base64_encode( $imageStr );
                $product->image_type = $imageType;
            } else {
                $product->image = $product->image;
            }
            $product->quantity = $request->quantity;
            $product->unit_id = $request->unit_id;
            $product->status = $request->status;
            $product->description = $request->description;
            if($request->discount == "on") {
                
                if(isset($request->discount_amount)) {
                    $discountAmount = $product->discount_amount = $request->discount_amount;
                    $product->discount_percentage = null;
                    $salePrice = $request->price - $discountAmount;
                    $product->sale_price = $salePrice;
                }
                if(isset($request->discount_percentage)) {
                    $discountPercent = $product->discount_percentage = $request->discount_percentage;
                    $product->discount_amount = null;
                    $discountAmount = $product->price * ($discountPercent / 100);
                    $salePrice = $request->price - $discountAmount;
                    $product->sale_price = $salePrice;
                }   
                
            } else {
                $product->sale_price = $request->sale_price;
            }
            
            if(isset($request->special_image) && $request->special_offer == "on") {
                if ($request->has('special_image')) {
                    $product->special_offer = $request->special_offer;
                    $special_image = $request->file( 'special_image' );  
                    $special_imageType = $special_image->getClientOriginalExtension();
                    $special_imageStr = (string) Image::make( $special_image )->
                                            resize( 350, 350, function ( $constraint ) {
                                                $constraint->aspectRatio();
                                            })->encode( $special_imageType );
    
                    $product->special_image = base64_encode( $special_imageStr );
                    $product->special_image_type = $special_imageType;
                }
            } else {
                $product->special_offer = null;
                $product->special_image = null;
                $product->special_image_type = null;
            }

            $product->meta_title = $request->meta_title;

            if ($request->has('pre_meta_tags') && isset($request->pre_meta_tags) && $request->has('hidden_meta_tags') && isset($request->hidden_meta_tags)) { 
                $product->meta_tags = json_encode(explode(",",$request->pre_meta_tags.','.$request->hidden_meta_tags));
            } elseif ($request->has('hidden_meta_tags') && isset($request->hidden_meta_tags)) {
                $product->meta_tags = json_encode(explode(",",$request->hidden_meta_tags));
            } elseif ($request->has('pre_meta_tags') && isset($request->pre_meta_tags)) {
                $product->meta_tags = json_encode(explode(",",$request->pre_meta_tags));
            } else {
                $product->meta_tags = $product->meta_tags;
            }
            
            $product->meta_description = $request->meta_description;

            if($product->save()) {
                $product->categories()->attach($request->category_id);
                Session::flash('message','Product has been updated successfully.');
            } else {
                Session::flash('warning','Something is wrong when updating product.');
            }
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $product->categories()->detach($product);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $products = Product::destroy($request->product_ids);
        if($products) {
            return response()->json(['message'=>'Products has been deleted successfully.'],200);
        } else {
            return response()->json(['warning'=>'Products has not been deleted successfully. Some errors detected!'],422);
        }
    }
}
