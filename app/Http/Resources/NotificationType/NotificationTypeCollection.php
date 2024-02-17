<?php

namespace App\Http\Resources\NotificationType;

use App\Http\Resources\PaginateResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationTypeCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'items'=> NotificationTypeResource::collection($this->collection),
            'info'=> PaginateResource::make($this),

        ];
    }
}
