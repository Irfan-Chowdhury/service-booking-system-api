<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            return [
                'token' => $user->createToken('ServiceBookingApp')->plainTextToken,
                'user' => $user,
            ];
        });
    }

    public function login(array $credentials): array
    {
        if (! Auth::attempt($credentials)) {
            throw new Exception('Invalid credentials', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('ServiceBookingApp')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    public function logout($user): void
    {
        $user->currentAccessToken()->delete();
    }
}
