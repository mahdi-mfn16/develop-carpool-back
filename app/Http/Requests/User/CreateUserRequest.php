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
            'name' => 'sometimes|nullable|string|min:3',
            'family' => 'sometimes|nullable|string|min:3',
            'birth_day' => 'sometimes|nullable|date_format:Y-m-d',
            'gender' => 'sometimes|nullable|int|in:0,1,2',
            'national_code' => 'sometimes|nullable|string|min:10|max:10',
        ];
    }
}
