<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            // 'user_name' => 'nullable|string',
            'password' => 'required|string',
            'birth_day' => 'nullable|date_format:Y-m-d',
            'province_id' => 'required|int|exists:provinces,id',
            'city_id' => 'required|int|exists:cities,id',
            'age' => 'required|int|min:7',
            'gender' => 'required|int|in:0,1,2',
            'about_me' => 'nullable|string|max:256',
        ];
    }
}
