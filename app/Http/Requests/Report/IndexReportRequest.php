<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class IndexReportRequest extends FormRequest
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
            'filters.reported_user_id' => 'sometimes|nullable|numeric|exists:users,id',
            'filters.report_type_id' => 'sometimes|nullable|numeric|exists:report_types,id',
            'filters.search' => 'sometimes|nullable|string',
        ];
    }
}
