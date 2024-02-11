<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'rate_id' => 'required|numeric|exists:rates,id',
            'reviewed_user_id' => 'required|numeric|exists:users,id',
            'text' => 'sometimes|nullable|string',
        ];
    }
}
