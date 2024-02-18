<?php

namespace App\Http\Resources\User;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> UserResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
