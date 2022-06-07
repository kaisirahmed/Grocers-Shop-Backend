<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Crypt;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        //$this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        $hashids = new Hashids('', 10);

    //     try {
    //         if ($hashids->decode($request->user_id)[0] != $request->user()->getKey()) {
    //             return response()->json(['message'=>'The link is '],400);
    //         }
    //         if($hashids->decode($request->signature)[0] != date("Ymd")) {
    //             return response()->json(['message'=>'The verification link is Expired'],400);
    //         }
    //         if(Carbon::now()->timestamp > $request->expired_at) {
    //             return response()->json(['message'=>'The verification link required time is over.'],400);
    //         }
    //     } catch (DecryptException $e) {
    //         return response()->json(['message'=>'The link is invalid'],400);
    //     }

    //     if ($request->user()->hasVerifiedEmail()) {
    //         return response()->json(['message'=>'User Email is already verified.'],200);
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return response()->json(['message'=>'User Email is verified successfully.','user'=>$request->user()],201);
    }

    /**
     * Resend the email verification notification.
     *
     * @authenticated
     * @response status=202 scenario="Success" {}
     * @response status=400 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? new Response('', 204)
                : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
            ? new Response('', 202)
            : back()->with('resent', true);
    }
}
