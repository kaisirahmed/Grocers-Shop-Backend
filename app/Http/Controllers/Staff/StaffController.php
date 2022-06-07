<?php

namespace App\Http\Controllers\Staff;

use App\Staff;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff()
    {
        return view('admin.index.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all()->sortByDesc('created_at');
        return view('staff.index', compact('staff'));
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
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(staff $staff)
    {
        return view('staff.edit',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, staff $staff)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string'],
        ]);

        if ($validator->fails()) {  
            return redirect()->back()->withErrors($validator);
        }else{
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->role = $request->role;
            $staff->save();

            $data = array(
                'admin' =>  Auth::user()->name,
                'name'  =>  $request->name,
                'email' =>  $request->email,
                'role' =>   $request->role,  
            );

            //Mail::to($request['email'])->send(new AdminMail($data));

            return redirect('/admin/staff')->with('message',ucfirst($request->role).' updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(staff $staff)
    {
        $staff->destroy($staff->id);

        return redirect('admin/staff')->with(['message'=>$staff->name.' as '.$staff->role == 'account' ? 'an ' : 'a '.$staff->role.' has been deleted successfully.']);
    }
}
