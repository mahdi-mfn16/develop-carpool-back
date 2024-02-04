<?php

namespace App\Http\Resources\Ride;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RideCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> RideResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
