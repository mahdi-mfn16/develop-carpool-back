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
        $limit = $request->input('limit');
        return $this->repository->getMyRides($limit);
    }


    public function getAllRides($request)
    {
        $limit = $request->input('limit');
        $filters = $request->input('filters');
        return $this->repository->getAllRides($limit, $filters);
    }


    public function createRide($request)
    { 

        /// ?????? to do
        return $this->repository->createRide();
    }



   
    
}