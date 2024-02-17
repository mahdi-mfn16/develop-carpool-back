<?php

namespace App\Http\Resources\NotificationType;

use App\Http\Resources\User\UserCompactResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class NotificationTypeResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name' => $this->name,
            'text' => $this->text,
           
        ];
    }
}
