<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\NotificationTypeRepositoryInterface;
use App\Services\BaseService;

class NotificationTypeService extends BaseService
{
    public function __construct(
        NotificationTypeRepositoryInterface $notificationTypeRepo
    )
    {
        parent::__construct($notificationTypeRepo);
    }


    public function getNotificationTypes($request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getNotificationTypes($filters, $limit);
    }

    
}