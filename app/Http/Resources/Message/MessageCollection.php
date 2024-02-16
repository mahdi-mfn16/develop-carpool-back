<?php

namespace App\Http\Resources\Message;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> MessageResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
