<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data= [
            [
                'name' => 'Mister Admin',
                'email' => 'admin@example.com',
                'role' => UserRole::ADMIN,
                'password' => Hash::make('admin123'),
                'created_at' => now(),
            ],
            [
                'name' => 'Irfan Chowdhury',
                'email' => 'irfan123@gmail.com',
                'role' => UserRole::CUSTOMER,
                'password' => Hash::make('irfan123'),
                'created_at' => now(),
            ],
            [
                'name' => 'Promi Chowdhury',
                'email' => 'promi123@gmail.com',
                'role' => UserRole::CUSTOMER,
                'password' => Hash::make('promi123'),
                'created_at' => now(),
            ],
        ];

        DB::table('users')->delete();
        User::insert($data);
    }
}
