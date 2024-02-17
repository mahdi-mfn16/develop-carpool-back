<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\VehicleRepositoryInterface;
use App\Services\BaseService;

class VehicleService extends BaseService
{
    public function __construct(
        VehicleRepositoryInterface $vehicleRepo
    )
    {
        parent::__construct($vehicleRepo);
    }



    public function getVehicles($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getVehicles($filters, $limit);
    }



}