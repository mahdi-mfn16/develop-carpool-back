<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UploadUserFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|size:2048|dimensions:min_width=200,min_height=200,max_width=1000,max_height=1000',
            'type' => 'required|string|in:profile,drive_license_back,drive_license_front,vehicle_card_back,vehicle_card_front,selfie'

        ];
    }
}
