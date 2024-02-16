<?php

namespace App\Http\Resources\Message;

use App\Http\Resources\RideApply\RideApplyResource;
use App\Http\Resources\User\UserCompactResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MessageResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'from_user' => UserCompactResource::make($this->whenLoaded('from_user')),
            'is_owner' => ($this->from_user_id == auth('sanctum')->id()) ? true : false,
            'message' => $this->message,
            'is_read' => $this->is_read,
            'time' => Carbon::parse($this->created_at)->format('H:i'),
            'date' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
 
        ];
    }
}
