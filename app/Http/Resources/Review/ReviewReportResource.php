<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ReviewReportResource extends JsonResource
{
   
    public function toArray($request)
    {

        return [
            'avg_rate' => $this->avg('rate'),
            'review_count' => $this->count(),
            'rate_report' => $this->groupBy('rate')->map(function($item, $index){
                return ['rate' => $index, 'count' => $item->count()];
            })->values(),
           
        ];
    }
}
