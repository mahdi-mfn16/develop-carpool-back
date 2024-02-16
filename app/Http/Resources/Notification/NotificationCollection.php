<?php

namespace App\Http\Resources\Notification;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> NotificationResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
