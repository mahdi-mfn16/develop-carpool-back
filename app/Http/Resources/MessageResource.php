<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'from_user_id'=> $this->from_user_id,
            'to_user_id'=> $this->to_user_id,
            'message'=> $this->message,
            'is_read'=> $this->is_read,
            'time' => Carbon::parse($this->updated_at)->format('H:i'),
            'date' => Carbon::parse($this->updated_at)->format('Y-m-d'),
        ];
    }
}
