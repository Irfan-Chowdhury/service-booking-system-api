<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthService
{
    public function register(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            return [
                'token' => $user->createToken('MyApp')->plainTextToken,
                'user'  => $user,
            ];
        });
    }
}
