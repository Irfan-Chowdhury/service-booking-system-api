<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseController
{
    public function register(RegisterRequest $request, AuthService $authService)
    {
        try {
            $result = $authService->register($request->validated());

            // return $this->successResponse( 'User registered successfully.', new UserResource($result['user']), 201);

            return (new UserResource($result['user']))->additional([
                'token' => $result['token'],
                'statusCode' => 201,
                'success' => true,
                'message' => 'User registered successfully.'
            ]);

        } catch (Exception $e) {
            return $this->errorResponse('Registration failed : '. $e->getMessage(), 500);
        }
    }
}
