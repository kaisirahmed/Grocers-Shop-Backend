<?php

namespace App\Http\Controllers\CMS;

use App\Cms;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms = Cms::all();
        return view('cms.index',compact('cms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cms $cms)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100','unique:cms,name'],
            'name_bn' => ['required','string','max:100','unique:cms,name_bn'],
            'content' => ['required','string','unique:cms,content'],
            'content_bn' => ['required','string','unique:cms,content_bn'],
            'slug' => ['required','string','unique:cms,slug'],
            'status' => ['required','integer'],
            'visibility' => ['required','integer'],
            'hidden_meta_tags' => ['nullable'],
            'meta_title' => ['nullable','string'],
            'meta_title_bn' => ['nullable','string'],
            'meta_description' => ['nullable','string'],
        ],
        [
            'name_bn.required' => 'The name in bangla field is required.',
            'name_bn.unique' => 'The name in bangla field is already extsts.',
            'content_bn.required' => 'The Content in bangla field is required.',
            'content_bn.unique' => 'The Content in bangla field is already exists.',
            'slug.required' => 'Permalink field is required',
            'slug.unique' => 'Permalink field is already exists.',
        ]);
        

        if ($validator->fails()) {
            return $validator->validate()->withInput();
        } else {
            $cms->name = $request->name;
            $cms->name_bn = $request->name_bn;
            $cms->content = $request->content;
            $cms->content_bn = $request->content_bn;
            $cms->meta_tags = empty($request->hidden_meta_tags) ? null : json_encode(explode(",",$request->hidden_meta_tags));
            $cms->visibility = $request->visibility;
            $cms->slug = $request->slug;
            $cms->status = $request->status;
            $cms->meta_title = $request->meta_title;
            $cms->meta_title_bn = $request->meta_title_bn;
            $cms->meta_description = $request->meta_description;
            
            if($cms->save()) {
                Session::flash('message',$cms->name.' page is created successfully.');
            } else {
                Session::flash('warning','Something is wrong when creating page.');
            }

            return redirect()->route('admin.cms.index');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        $cms = Cms::all();
        $pdf = PDF::loadView('cms.pdf',compact('cms'));
        $pdf->SetProtection(['print'], '', 'grocers');
        return $pdf->stream(''."Page Lists".'.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function show(Cms $cms)
    {  
        return view('cms.show',compact('cms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function edit(Cms $cms)
    {
        return view('cms.edit',compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cms $cms)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'name_bn' => ['required','string','max:100'],
            'content' => ['required','string'],
            'content_bn' => ['required','string'],
            'slug' => ['required','string'],
            'status' => ['required','integer'],
            'visibility' => ['required','integer'],
            'hidden_meta_tags' => ['nullable'],
            'meta_title' => ['nullable','string'],
            'meta_title_bn' => ['nullable','string'],
            'meta_description' => ['nullable','string'],
        ],
        [
            'name_bn.required' => 'The name in bangla field is required.',
            'content_bn.required' => 'The Content in bangla field is required.',
            'slug.required' => 'Permalink field is required',
        ]);

        if ($validator->fails()) {
            return $validator->validate();
        } else {
            $cms->name = $request->name;
            $cms->name_bn = $request->name_bn;
            $cms->content = $request->content;
            $cms->content_bn = $request->content_bn;
            if ($request->has('pre_meta_tags') && isset($request->pre_meta_tags) && $request->has('hidden_meta_tags') && isset($request->hidden_meta_tags)) { 
                $cms->meta_tags = json_encode(explode(",",$request->pre_meta_tags.','.$request->hidden_meta_tags));
            } elseif ($request->has('hidden_meta_tags') && isset($request->hidden_meta_tags)) {
                $cms->meta_tags = json_encode(explode(",",$request->hidden_meta_tags));
            } elseif ($request->has('pre_meta_tags') && isset($request->pre_meta_tags)) {
                $cms->meta_tags = json_encode(explode(",",$request->pre_meta_tags));
            } else {
                $cms->meta_tags = $cms->meta_tags;
            }
            $cms->visibility = $request->visibility;
            $cms->slug = $request->slug;
            $cms->status = $request->status;
            $cms->meta_title = $request->meta_title;
            $cms->meta_title_bn = $request->meta_title_bn;
            $cms->meta_description = $request->meta_description;

            if($cms->save()) {
                Session::flash('message',ucfirst($cms->name).' page is updated successfully.');
            } else {
                Session::flash('warning','Something is wrong when updating page.');
            }

            return redirect()->route('admin.cms.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cms $cms)
    {
        $cms->delete();
        return redirect()->route('admin.cms.index');
    }
}
