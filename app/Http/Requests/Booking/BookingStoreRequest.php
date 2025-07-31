<?php

namespace App\Http\Requests\Booking;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === UserRole::CUSTOMER->value;
    }

    public function failedAuthorization()
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json([
            'statusCode' => 403,
            'success' => false,
            'message' => 'Forbidden',
            'errors' => ['authorization' => ['You do not have permission to access this resource.']],
        ], 403));
    }

    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'booking_date.after_or_equal' => 'You cannot book a service on a past date.',
        ];
    }
}
