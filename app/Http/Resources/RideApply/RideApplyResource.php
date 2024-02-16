<?php

namespace App\Http\Resources\RideApply;

use App\Http\Resources\Preference\PreferenceResource;
use App\Http\Resources\Ride\RideCompactResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RideApplyResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'ride' => RideCompactResource::make($this->whenLoaded('ride')),
            'capacity' => $this->capacity,
            'price' => $this->price,
            'fee' => $this->fee,
        ];
    }
}
