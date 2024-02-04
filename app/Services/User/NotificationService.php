<?php

namespace App\Services\User;

use App\Repositories\Interfaces\User\NotificationRepositoryInterface;
use App\Services\BaseService;

class NotificationService extends BaseService
{
    public function __construct(
        NotificationRepositoryInterface $notifRepo
    )
    {
        parent::__construct($notifRepo);
    }


    public function getUserNofications($userId)
    {
        return $this->repository->getUserNofications($userId);
    }



    public function createNotification($userId, $type, $params = [], $message = null)
    {
        return $this->repository->createNotification($userId, $type, $params, $message);
    }

    
}