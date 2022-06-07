<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function logoutResponse($logout, $message) {
        $response = [
            'success' => true,
            'logout' => $logout,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function sendError($errorMessages, $code = 422)
    {
    	$response = [
            'success' => false,
        ];


        if(!empty($errorMessages)){
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
