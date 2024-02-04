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



}