<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'user_id' => 1,
                'service_id' => 1,
                'booking_date' => now()->addDay()->toDateString(),
                'status' => 'pending',
                'created_at' => now(),
            ],
            [
                'user_id' => 1,
                'service_id' => 2,
                'booking_date' => now()->addDay()->toDateString(),
                'status' => 'pending',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'service_id' => 3,
                'booking_date' => now()->addDay()->toDateString(),
                'status' => 'confirmed',
                'created_at' => now(),
            ],
            [
                'user_id' => 2,
                'service_id' => 4,
                'booking_date' => now()->addDay()->toDateString(),
                'status' => 'confirmed',
                'created_at' => now(),
            ],
            // Add more bookings as needed
        ];

        Booking::insert($bookings);
    }
}
