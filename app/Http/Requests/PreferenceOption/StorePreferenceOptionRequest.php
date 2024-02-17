<?php

namespace App\Http\Requests\PreferenceOption;

use Illuminate\Foundation\Http\FormRequest;

class StorePreferenceOptionRequest extends FormRequest
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
            'preference_id' => 'required|numeric|exists:preferences,id',
            'text' => 'required|string|min:1',
        ];
    }
}
