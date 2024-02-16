<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Http\Resources\Notification\NotificationResource;
use App\Services\Admin\NotificationTypeService;
use App\Services\User\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function __construct(
        private NotificationService $notificationService,
        private NotificationTypeService $notificationTypeService
    )
    {}
    

    /**
     * get list of user notifications.
     *
     */
    public function getUserNofications()
    {
        $userId = auth('sanctum')->id();
        $notifs = $this->notificationService->getUserNofications($userId);
        return $this->successArrayResponse(NotificationResource::collection($notifs));
    }



}
