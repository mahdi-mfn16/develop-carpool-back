<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PaginateResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'last_page'=> $this->lastPage(),
            'current_page'=> $this->currentPage(),
            'total'=> $this->total(),
        ];
    }
}
