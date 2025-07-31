<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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


    public function login(LoginRequest $request, AuthService $authService)
    {

        try {
            $result = $authService->login($request->validated());

            return $this->successResponse(
                'Login successful.',
                [
                    'token' => $result['token'],
                    'user'  => new UserResource($result['user']),
                ],
                200
            );


        } catch (Exception $e) {
            $statusCode = $e->getCode() === 401 ? 401 : 500;

            return $this->errorResponse('Login failed: ' . $e->getMessage(), $statusCode);
        }
    }


    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        try {
            $authService->logout($request->user());
            return $this->successResponse('Logout successful.', [], 200);
        } catch (Exception $e) {
            return $this->errorResponse('Logout failed: ' . $e->getMessage(), 500);
        }
    }
}
