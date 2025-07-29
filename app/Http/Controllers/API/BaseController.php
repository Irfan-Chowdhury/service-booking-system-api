<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successResponse(string $message, object|array $result, int $code = 200)
    {
        $response = [
            'statusCode' => $code,
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, $code);
    }

    public function errorResponse(string|array $message, int $code = 500)
    {
        $response = [
            'statusCode' => $code,
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }
}
