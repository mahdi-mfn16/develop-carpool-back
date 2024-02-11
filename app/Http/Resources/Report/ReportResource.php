<?php

namespace App\Http\Resources\Report;

use App\Http\Resources\ReportType\ReportTypeResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'id'=> $this->id,
            'user' => UserResource::collection($this->whenLoaded('user')),
            'reported_user' => UserResource::collection($this->whenLoaded('reportedUser')),
            'report_type' => ReportTypeResource::collection($this->whenLoaded('reportType')),
            'text' => $this->text,
        ];
    }
}
