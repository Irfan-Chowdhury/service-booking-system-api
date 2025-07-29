<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successResponse($message, $result, $code = 200)
    {
        $response = [
            'statusCode' => $code,
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, $code);
    }

    public function errorResponse($message, $code = 500)
    {
        $response = [
            'statusCode' => $code,
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
