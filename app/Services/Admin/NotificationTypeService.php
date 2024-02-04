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

    
}