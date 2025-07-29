<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceCreateRequest;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use Exception;
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

    public function store(ServiceCreateRequest $request, ServiceService $serviceService)
    {
        try {
            $service = $serviceService->createService($request->validated());

            return (new ServiceResource($service))->additional([
                'statusCode' => 201,
                'success' => true,
                'message' => 'Service created successfully.'
            ]);


        } catch (Exception $e) {
            return $this->errorResponse('Failed to create service: ' . $e->getMessage(), 500);
        }
    }
}
