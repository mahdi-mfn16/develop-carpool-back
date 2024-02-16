<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> ChatResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
