<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\Rate\RateResource;
use App\Http\Resources\Ride\RideResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ReviewResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user'=> UserResource::make($this->whenLoaded('user')),
            'reviewed_user'=> UserResource::make($this->whenLoaded('reviewedUser')),
            'ride'=> RideResource::make($this->whenLoaded('ride')),
            'rate'=> $this->rate,
            // 'rate'=> RateResource::make($this->whenLoaded('rate')),
            'text'=> $this->text,
            'created_at'=> $this->created_at,
        ];
    }
}
