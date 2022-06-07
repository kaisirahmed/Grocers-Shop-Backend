<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\CategoryProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoryCollection(Category::orderBy('order_no','desc')->where('status', 1)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function products($slug)
    {
        if(Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            if(Category::where('parent_id', $category->id)->exists()) {
               // dd($subcategories);
                return new CategoryProductCollection(Category::where('parent_id', $category->id)->get(),Category::where('slug', $slug)->first());
            } else {
                return new ProductCollection($category->products, Category::where('slug', $slug)->first());
            }
        } elseif(Product::where('slug', $slug)->exists()){
            return new ProductResource(Product::where('slug', $slug)->first());
        } else {
            return response()->json(['success'=> false,'data'=> [],'pcat' => null]);
        }
        
    }

}
