<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserFileAdminIndexRequest extends FormRequest
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
            'limit' => 'sometimes|nullable|numeric',
            'page' => 'sometimes|nullable|numeric',
            'filters' => 'sometimes|array',
            'filters.type' => 'sometimes|nullable|string|in:profile,drive_license,selfie',
        ];
    }
}