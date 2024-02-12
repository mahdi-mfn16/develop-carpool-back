<?php

namespace App\Http\Resources\RideApply;

use App\Http\Resources\Preference\PreferenceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RideApplyResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user_id' => $this->user_id,
            'ride_id' => $this->ride_id,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'fee' => $this->fee,
        ];
    }
}
