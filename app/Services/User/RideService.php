<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\RideRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Log;

class RideService extends BaseService
{
    public function __construct(
        RideRepositoryInterface $rideRepo
    )
    {
        parent::__construct($rideRepo);
    }


    public function getMyRides($request)
    {
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getMyRides($limit);
    }


    public function getAllRides($request)
    {
        $limit = $request->input('limit') ?: 10;
        $filters = $request->input('filters');
        return $this->repository->getAllRides($limit, $filters);
    }


    public function getAdminRideList($request)
    {
        $limit = $request->input('limit') ?: 10;
        $filters = $request->input('filters');
        return $this->repository->getAdminRideList($limit, $filters);
    }


    public function createRide($request)
    { 

        /// ?????? to do
        return $this->repository->createRide();
    }



   
    
}