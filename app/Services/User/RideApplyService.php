<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\RideApplyRepositoryInterface;
use App\Repositories\Interfaces\User\RideRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Log;

class RideApplyService extends BaseService
{
    public function __construct(
        RideApplyRepositoryInterface $rideApplyRepo,
        private RideRepositoryInterface $rideRepo
    )
    {
        parent::__construct($rideApplyRepo);
    }


    public function sendRideApply($request, $ride)
    {
        $userId = auth('sanctum')->id();
        $capacity = $request->input('capacity');
        $price = $request->input('price');

        $oldApply = $this->repository->findOneWithConditions([
            ['user_id', '=', $userId],
            ['ride_id', '=', $ride['id']]
        ]);

        if($oldApply){
            return null;
        }
        
        if($capacity > ($ride['capacity'] - $ride['booked'])){
            return null;
        }


        $ride->update(['booked' => $ride['booked'] + $capacity ]);

        $rideApply = $this->createItem([
            'user_id' => $userId,
            'capacity' => $capacity,
            'ride_id' => $ride['id'],
            'price' => $price,
            'fee' => $ride['fee'] * $capacity,
            'status' => 0, // pending

        ]);

        // job for create chat and message and notif

        return $rideApply;

    }



    public function cancelRideApply($request, $ride)
    {

    }



    public function responseRideApply($request, $rideApply)
    {
        $action = $request->input('action');

        $ride = $rideApply->ride;
        
        $rideApply->update([
            'status' => config('setting.ride_apply_status.'.$action)
        ]);

        if($action == 'reject'){
            $ride->update([
                'booked' => $ride['booked'] - $rideApply['capacity']
            ]);
            // job for sending notif and message of reject
        }else{
            // job for sending notif and message of accept
        }




    }


    


   
    
}