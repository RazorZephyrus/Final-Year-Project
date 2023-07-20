<?php

namespace App\Http\Requests\Web\PaidLeave;

use Illuminate\Foundation\Http\FormRequest;

class PaidLeaveRequest extends FormRequest
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
            'employee_id' => 'required|exists:employees,uuid',
            'paid_leave_type_id' => 'required|exists:paid_leave_types,uuid',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }
}
