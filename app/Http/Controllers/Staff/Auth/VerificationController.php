<?php

namespace App\Http\Controllers\Staff\Auth;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    /**
     * Create a controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:staff');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify','resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $request->user('staff')->sendEmailVerificationNotification();
        return $request->user('staff')->hasVerifiedEmail()
            ? redirect()->route('staff')
            : view('staff.auth.verify',[
                'resendRoute' => 'verification.resend',
            ]);
    }

    /**
     * Verfy the user email.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user('staff')->getKey()) {
            //id value doesn't match.
            return redirect()
                    ->route('staff.verification.notice')
                    ->with('error','Invalid user!');
        }

        if ($request->user('staff')->hasVerifiedEmail()) {
            return redirect()
                    ->route('staff');
        }

        $staff = Staff::find($request->route('id'));
        $staff->update([
            'join_date' => now(),
            'separation_date' => now()
        ]);
             
        $request->user('staff')->markEmailAsVerified();

        return redirect()
            ->route('staff')
            ->with('status','Thank you for verifying your email!');
    }

    /**
     * Resend the verification email.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user('staff')->hasVerifiedEmail()) {
            return redirect()->route('staff');
        }

        $request->user('staff')->sendEmailVerificationNotification();

        return redirect()
                ->back()
                ->with('status','We have sent you a verification email!');
    }
}
