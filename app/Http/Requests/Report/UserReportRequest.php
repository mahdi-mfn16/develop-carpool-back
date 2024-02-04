<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

class UserReportRequest extends FormRequest
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
            'reported_user_id' => 'required|numeric|exists:users,id',
            'report_type_id' => 'required|numeric|exists:report_types,id',
            'report_text' => 'sometimes|nullable|string|max:256'
        ];
    }
}
