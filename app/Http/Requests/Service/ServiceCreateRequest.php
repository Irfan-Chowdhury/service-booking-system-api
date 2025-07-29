<?php

namespace App\Http\Requests\Service;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === UserRole::ADMIN->value;
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
            'name'        => ['required', 'string', 'max:255', 'unique:services,name'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'status'      => ['boolean'],
        ];
    }
}
