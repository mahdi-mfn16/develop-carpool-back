<?php

namespace App\Http\Resources\Notification;

use App\Http\Resources\User\UserCompactResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class NotificationResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'notification_type_id' => $this->notification_type_id,
            'message' => $this->message,
        ];
    }
}
