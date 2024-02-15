<?php

namespace App\Services\User;

use App\Repositories\Interfaces\Admin\NotificationTypeRepositoryInterface;
use App\Repositories\Interfaces\User\NotificationRepositoryInterface;
use App\Services\BaseService;

class NotificationService extends BaseService
{
    public function __construct(
        NotificationRepositoryInterface $notifRepo,
        private NotificationTypeRepositoryInterface $notifTypeRepo
    )
    {
        parent::__construct($notifRepo);
    }


    public function getUserNofications($userId)
    {
        return $this->repository->getUserNofications($userId);
    }



    public function createNotification($userId, $typeName, $params = [], $message = null)
    {
        $type = $this->notifTypeRepo->getNotificationType($typeName);
        return $this->repository->createNotification($userId, $type, $params, $message);
    }

    
}