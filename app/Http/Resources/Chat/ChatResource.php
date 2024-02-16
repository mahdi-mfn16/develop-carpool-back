<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\RideApply\RideApplyResource;
use App\Http\Resources\User\UserCompactResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ChatResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user'=> UserCompactResource::make($this->whenLoaded('user')),
            'ride_apply' => RideApplyResource::make($this->whenLoaded('rideApply')),
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
        ];
    }
}
