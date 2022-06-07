<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Http\Controllers\Controller;
use App\Staff;
use App\Permission;
use App\Mail\StaffMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff',['except'=>['create','showRegistrationForm','register']]);
    }

    public function showRegistrationForm()
    {
        $permissions = Permission::all();
        return view('staff.auth.register',compact('permissions'));
    }

    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:staff'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Admin
     */
    protected function create(Request $request, Staff $staff)
    { 
        $this->validator($request->all())->validate();

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = Hash::make($request['password']);
        $staff->role = $request->role;
        $staff->save();
        $staff->permissions()->attach($request->names);
 
        
        $data = array(
            'admin' =>  Auth::user()->name,
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password' =>  $request->password,
            'role' =>  $request->role,  
        );
        
         
        if ($staff) {

            Mail::to($request['email'])->send(new StaffMail($data));
 
            return redirect('/admin/staff')->with('message', ucfirst($request->name).', role as '.ucfirst($request->role).' has been registered successfully.');
        }
        else{
            return redirect()->back()->with('error','Some error is occured.');
        }
    }
}
