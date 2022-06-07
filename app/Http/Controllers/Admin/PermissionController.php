<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Admin;
use App\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.permissions.index',compact('admins'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffIndex()
    {
        $staff = Staff::all();
        return view('staff.permissions.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffEdit($staffId)
    {
        $staff = Staff::findOrFail($staffId);
        $permissions = Permission::all();
        return view('staff.permissions.edit',compact('staff','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function staffUpdate(Request $request)
    { 
        $staff = Staff::findOrFail($request->staff_id); 
        $staff->role = $request->role;
        $staff->save();
        $staff->permissions()->sync($request->names);

        if($staff->save()){
            session()->flash('message',$staff->role.' permission is updated successfully!');
        }else{
            session()->flash('error','Errors in updating Staff!');
        }

        return redirect()->route('admin.staff.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function staffDestroy(Permission $permission)
    {
        // $permissions = Permission::all();
        // return view('admin.permissions.index',compact('permissions'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $permissions = Permission::all();
        return view('admin.permissions.edit',compact('admin','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $admin = Admin::findOrFail($request->admin_id); 
        $admin->permissions()->sync($request->names);

        if($admin->save()){
            session()->flash('message',$admin->role.' permission is updated successfully!');
        }else{
            session()->flash('error','Errors in updating user!');
        }

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
