<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> ReviewResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
