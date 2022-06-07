<?php

namespace App\Http\Controllers\Unit;

use App\Unit;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('unit.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Unit $unit)
    { 
        $validator = Validator::make($request->all(),
        [
            'short_format' => ['required','string','unique:units,short_format'],
            'full_format' => ['required','string','unique:units,full_format'],
        ],
        [
            'short_format.required'  =>  'The short unit name field is required.',
            'short_format.string' => 'The short unit name must be string.',
            'full_format.required' => 'The full unit name field is required.',
            'full_format.string' => 'The full unit name must be string',
        ]);

        if($validator->fails()) {
            $validator->validate()->withInput();
        } else {

            $unit->short_format = $request->short_format;
            $unit->full_format = $request->full_format;
            
            if($unit->save()){
                Session::flash('message','Units has been created successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating unit.');
            }
                             
            return redirect()->route('unit.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    { 
        return view('unit.edit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $validator = Validator::make($request->all(),
        [
            'short_format' => ['required','string'],
            'full_format' => ['required','string'],
        ],
        [
            'short_format.required'  =>  'The short unit name field is required.',
            'short_format.string' => 'The short unit name must be string.',
            'full_format.required' => 'The full unit name field is required.',
            'full_format.string' => 'The full unit name must be string',
        ]);

        if($validator->fails()) {
            $validator->validate()->withInput();
        } else {

            $unit->short_format = $request->short_format;
            $unit->full_format = $request->full_format;
            
            if($unit->save()){
                Session::flash('message','Units has been updated successfully.');
            } else {
                Session::flash('warning','Something is wrong when updating unit.');
            }
                             
            return redirect()->route('unit.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('unit.index');
    }
}
