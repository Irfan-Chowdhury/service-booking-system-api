<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServiceController extends BaseController
{
    public function index(ServiceService $serviceService): JsonResponse
    {
        $services = $serviceService->getAvailableServices();

        return $this->successResponse(
            'Available services retrieved successfully.',
            ServiceResource::collection($services),
            200
        );
    }
}
