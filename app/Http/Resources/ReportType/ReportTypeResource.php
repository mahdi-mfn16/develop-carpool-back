<?php

namespace App\Http\Resources\ReportType;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportTypeResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'name' => $this->name,
            'text' => $this->text,
            'children' => ReportTypeResource::collection($this->whenLoaded('children')),
            'parent' => ReportTypeResource::collection($this->whenLoaded('parent')),
        ];
    }
}
