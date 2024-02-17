<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class IndexAllReviewRequest extends FormRequest
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
            'filters.search' => 'sometimes|nullable|string',
            'filters.status' => 'sometimes|nullable|boolean',
        ];
    }
}
