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


    public function getUserVehicles($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getUserVehicles($filters, $limit);
    }




    public function createUserVehicle($userId, $request)
    {
        return $this->repository->createUserVehicle($userId, $request);
    }



    public function updateUserVehicle($vehicle, $request)
    {
        $this->repository->updateUserVehicle($vehicle, $request);
        return $this->showItem($vehicle['id']);
    }



    

    
}