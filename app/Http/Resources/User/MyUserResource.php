<?php

namespace App\Http\Resources\User;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\PreferenceOption\PreferenceOptionResource;
use App\Http\Resources\UserVehicle\UserVehicleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MyUserResource extends JsonResource
{
   
    public function toArray($request)
    {
        $profile = $this->whenLoaded('profile');
        $profile =  $profile ? $profile->first() : null;

        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'family'=> $this->family,
            'mobile'=> $this->mobile,
            'national_code'=> $this->national_code,
            'privilege' => $this->privilege,
            'birth_day' => Carbon::parse($this->birth_day)->format('Y-m-d'),
            'gender' => $this->gender,
            'about_me' => $this->bio_temp,
            'bio_status' => $this->bio_status,
            'status' => $this->status,
            'profile' => $profile ? FileResource::make($profile) : null,
            'preferences' => PreferenceOptionResource::collection($this->whenLoaded('preferenceOptions')),
            'preferences' => UserVehicleResource::collection($this->whenLoaded('vehicles')),

        ];
    }
}
