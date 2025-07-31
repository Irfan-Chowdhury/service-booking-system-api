<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Home Cleaning',
                'description' => 'Complete home cleaning service, including floors, bathrooms, and windows.',
                'price' => 1500.00,
                'status' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'AC Repair',
                'description' => 'Air conditioner repair and maintenance service.',
                'price' => 2500.00,
                'status' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Plumbing Service',
                'description' => 'Fixing leaks, installing taps, and other plumbing works.',
                'price' => 1200.00,
                'status' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Pest Control',
                'description' => 'Safe and effective pest control solutions for your home and office.',
                'price' => 3000.00,
                'status' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Car Wash',
                'description' => 'Premium car wash service with interior cleaning.',
                'price' => 800.00,
                'status' => true,
                'created_at' => now(),
            ],
        ];

        DB::table('services')->delete();

        Service::insert($services);
    }
}
