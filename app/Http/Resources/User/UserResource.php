<?php

namespace App\Http\Resources\User;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\PreferenceOption\PreferenceOptionResource;
use App\Http\Resources\Review\ReviewReportResource;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserResource extends JsonResource
{
   
    public function toArray($request)
    {

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
            'bio_status' => $this->bio_status,
            'selfie_status' => $this->selfie_status,
            'drive_license_status' => $this->drive_license_status,
            'status' => $this->status,
            'profile' => $this->getFileUrl('profile', true),
            'preferences' => PreferenceOptionResource::collection($this->whenLoaded('preferenceOptions')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'reviews_report' => ReviewReportResource::make($this->whenLoaded('reviews')),

        ];
    }
}
