<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\UserVehicleRepositoryInterface;
use App\Services\BaseService;

class UserVehicleService extends BaseService
{
    public function __construct(
        UserVehicleRepositoryInterface $userVehicleRepo
    )
    {
        parent::__construct($userVehicleRepo);
    }


    

    
}