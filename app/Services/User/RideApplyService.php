<?php

namespace App\Services\User;

use App\Events\SendRideApplyEvent;
use App\Events\SendUserNotificationEvent;
use App\Repositories\Interfaces\User\ChatRepositoryInterface;
use App\Repositories\Interfaces\User\RideApplyRepositoryInterface;
use App\Repositories\Interfaces\User\RideRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class RideApplyService extends BaseService
{
    public function __construct(
        RideApplyRepositoryInterface $rideApplyRepo,
        private RideRepositoryInterface $rideRepo,
        private ChatRepositoryInterface $chatRepo,
        private NotificationService $notificationService
    )
    {
        parent::__construct($rideApplyRepo);
    }


    public function sendRideApply($request, $ride)
    {
        $userId = auth('sanctum')->id();
        $capacity = $request->input('capacity');

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

        $rideApply = $this->createApply($userId, $ride, $capacity);

        return $rideApply;

    }


    public function createApply($userId, $ride, $capacity)
    {
        try {
            DB::beginTransaction();

            $ride->update(['booked' => $ride['booked'] + $capacity ]);

            $rideApply = $this->createItem([
                'user_id' => $userId,
                'capacity' => $capacity,
                'ride_id' => $ride['id'],
                'price' => $ride['price'],
                'fee' => $ride['fee'] * $capacity,
                'status' => 0, // pending

            ]);

            $chat = $this->chatRepo->create([
                'user_id_one' => $rideApply->user_id,
                'user_id_two' => $rideApply->ride->user_id,
                'ride_apply_id' => $rideApply->id,
            ]);

            return $rideApply;

            DB::commit();

        } catch (Exception $th) {
            DB::rollBack();
            return null;

        }

    }




    public function updateRideApplyStatus($request, $rideApply)
    {
        $action = $request->input('action');

        try {
            DB::beginTransaction();
            
            match($action){
                'accepted' => $this->acceptApply($rideApply),
                'rejected' => $this->rejectApply($rideApply),
                'canceled' => $this->cancelApply($rideApply),
                'accept_closed' => $this->closeApply($rideApply),
                'reject_closed' => $this->closeApply($rideApply),
            };
    
            $rideApply->update([
                'status' => config('setting.ride_apply_status.'.$action)
            ]);
    
            if($action == 'accepted' || $action == 'rejected'){
                $this->sendApplyResponseNotification($rideApply, $action);
            }

            DB::commit();

            return $this->showItem($rideApply['id']);

        } catch (Exception $th) {
            DB::rollBack();
            return null;

        }

 

    }

    public function acceptApply($rideApply)
    {
        if($rideApply['status'] != config('setting.ride_apply_status.pending')){
            throw new Exception('you cant do this');
        }

    }


    public function rejectApply($rideApply)
    {
        $ride = $rideApply->ride;

        if($rideApply['status'] != config('setting.ride_apply_status.pending')){
            throw new Exception('you cant do this');
        }

        $ride->update([
            'booked' => $ride['booked'] - $rideApply['capacity']
        ]);    

    }


    public function cancelApply($rideApply)
    {
        $ride = $rideApply->ride;
        $chat = $rideApply->chat;

        if($rideApply['status'] != config('setting.ride_apply_status.pending')){
            throw new Exception('you cant do this');
        }

        $ride->update([
            'booked' => $ride['booked'] - $rideApply['capacity']
        ]);   
         
        $chat->delete();

    }


    public function closeApply($rideApply)
    {
        if($rideApply['status'] != config('setting.ride_apply_status.accepted') || $rideApply['status'] != config('setting.ride_apply_status.rejected')){
            throw new Exception('you cant do this');
        }

    }


    public function sendApplyResponseNotification($rideApply, $action)
    {
        $ride = $rideApply->ride;
        $user = $ride->user;
        $notif = $this->notificationService->createNotification(
            $userId = $rideApply['user_id'],
            $typeName = 'update_apply_status',
            $params = [
                'rider_user_name'=> $user['name'],
                'action' => $action
            ]
        );

        event(new SendUserNotificationEvent($notif));
    }



    public function getRideApplyList($request)
    {
        $limit = $request->input('limit') ?: 10;
        $filters = $request->input('filters');
        return $this->repository->getRideApplyList($limit, $filters);
    }


 
   
    
}