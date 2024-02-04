<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class ManualPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plan_id' => 'required|int|exists:plans,id',
            'payment_code' => 'required|string',
            // 'file' => 'required|int|exists:files,id',
            'destination_name' => 'required|string',
            'destination_number' => 'required|string|min:16',
            'origin_number' => 'required|string|min:16',
            'payment_date' => 'required|date_format:H:i:s',
            'payment_time' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string',
        ];
    }
}
