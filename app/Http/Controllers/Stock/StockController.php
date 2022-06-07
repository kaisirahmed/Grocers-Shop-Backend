<?php

namespace App\Http\Controllers\Stock;

use App\Unit;
use App\Stock;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::latest()->get();
        return view('stock.index',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stockProductId = Stock::pluck('product_id');
        $products = Product::whereNotIn('id',$stockProductId)->get();
        return view('stock.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productUnit(Request $request)
    {
        $product = Product::where('id',$request->product_id)->first();

        $response = [
            'unit_id' => $product->unit_id,
            'unit_name' => $product->unit->short_format,
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Stock $stock)
    {
        $validator = Validator::make($request->all(),[
            'product_id' => ['required'],
            'quantity' => ['required','integer'],
            'unit_id' => ['required'],
        ],
        [
            'unit_id.required' => 'Unit field is required.',
            'product_id.required' => 'Product field is required.'
        ]);

        if($validator->fails()) {
            $validator->validate()->withInput();
        } else {
            $stock->product_id = $request->product_id;
            $stock->quantity = $request->quantity;
            $stock->unit_id = $request->unit_id;
            $stock->total_quantity = $request->quantity;

            if($stock->save()) {
                Session::flash('message', $stock->product->name.' Stock is created successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating stock.');
            }
            return redirect()->route('stock.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $stocks = Stock::latest()->get();
        $pdf = PDF::loadView('stock.pdf',compact('stocks'));
        $pdf->SetProtection(['print'], '', 'grocers');
        return $pdf->stream(''."Stocks".'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $product = Product::where('id',$stock->product_id)->first();
        return view('stock.edit',compact('product','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $validator = Validator::make($request->all(),[
            'product_id' => ['required'],
            'quantity' => ['required','integer'],
            'unit_id' => ['required'],
        ],
        [
            'unit_id.required' => 'Unit field is required.',
            'product_id.required' => 'Product field is required.'
        ]);

        if($validator->fails()) {
            $validator->validate()->withInput();
        } else {
            $stock->product_id = $request->product_id;
            $stock->quantity = $stock->quantity + $request->quantity;
            $stock->unit_id = $request->unit_id;
            $stock->total_quantity = $stock->total_quantity + $stock->quantity;

            if($stock->save()) {
                Session::flash('message', $stock->product->name.' Stock is updated successfully.');
            } else {
                Session::flash('warning','Something is wrong when updating stock.');
            }
            return redirect()->route('stock.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index');
    }
}
