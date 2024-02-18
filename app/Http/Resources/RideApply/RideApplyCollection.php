<?php

namespace App\Http\Resources\RideApply;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RideApplyCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> RideApplyResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
