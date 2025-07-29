<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function getAvailableServices()
    {
        return Service::where('status', true)->get();
    }

    public function createService(array $data): Service
    {
        return Service::create($data);
    }
}
