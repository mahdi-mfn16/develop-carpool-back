<?php

namespace App\Http\Resources\User;

use App\Http\Resources\File\FileResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserResource extends JsonResource
{
   
    public function toArray($request)
    {
        $profile = $this->whenLoaded('profile');
        $profile = $profile->first();

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'family'=> $this->family,
            'mobile'=> $this->mobile,
            'national_code'=> $this->national_code,
            'privilege' => $this->privilege,
            'birth_day' => Carbon::parse($this->birth_day)->format('Y-m-d'),
            'gender' => $this->gender,
            'about_me' => $this->about_me,
            'status' => $this->status,
            'profile' => $profile ? FileResource::make($profile) : null,


        ];
    }
}
