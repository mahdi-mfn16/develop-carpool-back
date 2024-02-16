<?php

namespace App\Http\Resources\Ride;

use App\Http\Resources\City\CityResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RideCompactResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user'=> UserResource::make($this->whenLoaded('user')),
            'origin'=> CityResource::make($this->whenLoaded('origin')),
            'destination'=> CityResource::make($this->whenLoaded('destination')),
            'type'=> $this->type,
            'distance'=> $this->distance,
            'date'=> Carbon::parse($this->date)->format('Y-m-d'),
            'start_time'=> $this->start_time,
            'end_time'=> $this->end_time,
            'status'=> $this->status,

        ];
    }
}
