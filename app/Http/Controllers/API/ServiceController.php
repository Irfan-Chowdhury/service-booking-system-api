<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Service\ServiceCreateRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
                'message' => 'Service created successfully.',
            ]);

        } catch (Exception $e) {
            return $this->errorResponse('Failed to create service: '.$e->getMessage(), 500);
        }
    }

    public function update(ServiceUpdateRequest $request, ServiceService $serviceService, int $id)
    {
        try {
            $service = $serviceService->updateService($id, $request->validated());

            return (new ServiceResource($service))->additional([
                'statusCode' => 200,
                'success' => true,
                'message' => 'Service updated successfully.',
            ]);

        } catch (Exception $e) {
            return $this->errorResponse('Failed to update service: '.$e->getMessage(), 500);
        }
    }

    public function destroy(ServiceService $serviceService, int $id)
    {
        try {
            $serviceService->deleteService($id);

            return $this->successResponse(
                'Service deleted successfully.',
                [],
                200
            );
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Service not found.', 404);
        } catch (Exception $e) {
            return $this->errorResponse('Failed to delete service: '.$e->getMessage(), 500);
        }
    }
}
