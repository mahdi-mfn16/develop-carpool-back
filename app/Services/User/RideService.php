<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\DirectionRepositoryInterface;
use App\Repositories\Interfaces\User\RideApplyRepositoryInterface;
use App\Repositories\Interfaces\User\RideRepositoryInterface;
use App\Repositories\Interfaces\User\UserVehicleRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RideService extends BaseService
{
    public function __construct(
        RideRepositoryInterface $rideRepo,
        private UserVehicleRepositoryInterface $userVehicleRepo,
        private DirectionRepositoryInterface $directionRepo,
        private RideApplyRepositoryInterface $rideApplyRepo
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
        $this->checkRideUserVehicle($request->input('user_vehicle_id'));
        $this->checkOriginDestination($request->input('origin'), $request->input('destination'));
        $this->checkSameRideExist($request);

        try {

            DB::beginTransaction();
            $ride = $this->repository->createRide($request);
            $direction = $this->directionRepo->createDirection($ride, $request->input('direction'));
            DB::commit();
            return $this->showItem($ride['id']);
        
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
        
        

    }


    public function checkRideUserVehicle($userVehicleId)
    {
        $check = $this->userVehicleRepo->checkRideUserVehicle($userVehicleId);
        if(!$check){
            throw new Exception('this vehicle is not verified');
        }
    }


    public function checkOriginDestination($origin, $destination)
    {
        if( ($origin['lat'] == $destination['lat']) && ($origin['lng'] == $destination['lng']) ){
            throw new Exception('origin and destination is the same');
        }
    }


    public function checkSameRideExist($request)
    {
        $existed = $this->repository->checkSameRideExist($request->input('date'), $request->input('start_time'));
        if($existed){
            throw new Exception('You have submited one ride for this date');
        }
    }



    public function updateRide($ride, $request)
    { 
        $this->checkRideUserVehicle($request->input('user_vehicle_id'));
        $this->checkOriginDestination($request->input('origin'), $request->input('destination'));
        $this->checkUpdateSameRideExist($request, $ride);

        try {

            DB::beginTransaction();
            
            $this->repository->updateRide($ride, $request);
            
            if($request->input('direction')){
                $direction = $this->directionRepo->createDirection($ride, $request->input('direction'));
            }
            
            DB::commit();
            return $this->showItem($ride['id']);
        
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
        
        

    }


    public function checkUpdateSameRideExist($request, $ride)
    {
        $existed = $this->repository->checkSameRideExist($request->input('date'), $request->input('start_time'));
        if($existed && $existed['id'] != $ride['id']){
            throw new Exception('You have submited one ride for this date');
        }
    }



    public function cancelRide($ride)
    {
        $this->repository->cancelRide($ride);
                
        $this->rideApplyRepo->cancelRideUpdate($ride->rideApplies);

        return $this->showItem($ride['id']);

    }


   
    
}