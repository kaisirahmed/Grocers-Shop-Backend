<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Shows authenticated user information
     *
     * @authenticated
     *
     * @response 200 {
     *     "id": 2,
     *     "name": "Demo",
     *     "email": "demo@demo.com",
     *     "email_verified_at": null,
     *     "created_at": "2020-05-25T06:21:47.000000Z",
     *     "updated_at": "2020-05-25T06:21:47.000000Z"
     * }
     * @response status=400 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     */
    public function user()
    {
        return $this->sendResponse($data['user'] = auth()->user(),"Authenticate user");
    }
}
