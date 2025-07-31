<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\BookingStoreRequest;
use App\Http\Resources\BookingResource;
use Illuminate\Http\Request;
use App\Services\BookingService;
use Exception;

class BookingController extends BaseController
{
    public function store(BookingStoreRequest $request, BookingService $bookingService)
    {
        try {
            $booking = $bookingService->createBooking($request->validated(), auth()->id());

            return $this->successResponse(
                'Booking created successfully',
                new BookingResource($booking),
                200
            );

        } catch (Exception $e) {
            return $this->errorResponse('Failed to create booking: ' . $e->getMessage(), $e->getCode() ?: 500);
        }
    }
}
