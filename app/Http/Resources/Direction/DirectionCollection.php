<?php

namespace App\Http\Resources\Direction;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DirectionCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> DirectionResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
