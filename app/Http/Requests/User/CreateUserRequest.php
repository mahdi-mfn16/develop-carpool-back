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
            'name' => 'required|string|min:3',
            'family' => 'required|string|min:3',
            'birth_day' => 'required|date_format:Y-m-d',
            'gender' => 'required|int|in:0,1,2',
            'national_code' => 'required|string|min:10|max:10',
        ];
    }
}
