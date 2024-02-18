<?php

namespace App\Services\User;

use App\Events\SendUserNotificationEvent;
use App\Repositories\Interfaces\User\UserVehicleRepositoryInterface;
use App\Services\BaseService;

class UserVehicleService extends BaseService
{
    public function __construct(
        UserVehicleRepositoryInterface $userVehicleRepo,
        private NotificationService $notificationService
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


    public function updateStatus($userVehicle, $request)
    {
        $action = $request->input('action');
        $message = $request->input('message');
        $this->repository->updateStatus($userVehicle, $action);


        $notif = $this->notificationService->createNotification(
            $userId = $userVehicle['user_id'],
            $typeName = $action.'_user_vehicle_status',
            $params = [
                'message'=> $message,
            ],
            
        );

        event(new SendUserNotificationEvent($notif));
    }



    

    
}