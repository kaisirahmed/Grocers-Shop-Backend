<?php

namespace App\Http\Controllers\System;

use App\System;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $system = System::first();
        return view('system.index',compact('system'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('system.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, System $system)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => ['required', 'string', 'max:100'],
            'slogan' => ['required', 'max:100',],
            'logo' => ['required','image', 'mimes:png', 'max:512', 'dimensions:min_width=200,min_height=45'],
            'meta_title' => ['required', 'max:100'],
            'meta_description' => ['required'],
            'hidden_meta_tags' => ['required'],
        ],
        [
            'hidden_meta_tags.required' => 'Meta tags are required.'
        ]);

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {

            $system->site_name = $request->site_name;
            $system->slogan = $request->slogan;
            $image = $request->file( 'logo' );  
            $imageType = $image->getClientOriginalExtension();
            $imageStr = (string) Image::make( $image )->
                                     resize( 200, 45, function ( $constraint ) {
                                         $constraint->aspectRatio();
                                     })->encode( $imageType );

            $system->logo = base64_encode( $imageStr );
            $system->meta_title = $request->meta_title;
            $system->meta_description = $request->meta_description;
            $system->meta_tags = json_encode(explode(",",$request->hidden_meta_tags));
            
            if($system->save()) {
                Session::flash('message','App information created successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating app info.');
            }

            return redirect()->route('admin.system.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function show(System $system)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        return view('system.edit',compact('system'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, System $system)
    {   
        $validator = Validator::make($request->all(), [
            'site_name' => ['required', 'string', 'max:100'],
            'slogan' => ['required', 'max:100',],
            'meta_title' => ['required', 'max:100'],
            'meta_description' => ['required'],
        ]);

        if($request->hasFile('logo')) {
            $validator = Validator::make($request->all(), [
                'logo' => ['required','image', 'mimes:png', 'max:512', 'dimensions:min_width=200,min_height=45'],
                'meta_title' => ['required', 'max:100'],
            ]);
        }

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $system->site_name = $request->site_name;
            $system->slogan = $request->slogan;
            if($request->hasFile('logo')) {
                $image = $request->file( 'logo' );  
                $imageType = $image->getClientOriginalExtension();
                $imageStr = (string) Image::make( $image )->
                                     resize( 200, 45, function ( $constraint ) {
                                         $constraint->aspectRatio();
                                     })->encode( $imageType );

                $system->logo = base64_encode( $imageStr );
            } else {
                $system->logo = $system->logo;
            }

            if ($request->has('pre_meta_tags') && isset($request->pre_meta_tags) && $request->has('hidden_meta_tags') && isset($request->hidden_meta_tags)) { 
                 $system->meta_tags = json_encode(explode(",",$request->pre_meta_tags.','.$request->hidden_meta_tags));
            } elseif ($request->has('hidden_meta_tags') && isset($request->hidden_meta_tags)) {
                $system->meta_tags = json_encode(explode(",",$request->hidden_meta_tags));
            } elseif ($request->has('pre_meta_tags') && isset($request->pre_meta_tags)) {
                $system->meta_tags = json_encode(explode(",",$request->pre_meta_tags));
            } else {
                $system->meta_tags = $system->meta_tags;
            }
            
            $system->meta_title = $request->meta_title;
            $system->meta_description = $request->meta_description;

            if($system->save()) {
                Session::flash('message','App information updated successfully.');
            } else {
                Session::flash('warning','Something is wrong when updating app info.');
            }

            return redirect()->route('admin.system.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\System  $system
     * @return \Illuminate\Http\Response
     */
    public function destroy(System $system)
    {
        $system->destroy();
        Session::flash('message','App info deleted successfully.');
        return redirect()->back();
    }
}
