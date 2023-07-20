<?php

namespace App\Http\Requests\Web\Attendence;

use Illuminate\Foundation\Http\FormRequest;

class AttendenceRequest extends FormRequest
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
            'status' => 'required|min:1|max:2'
        ];
    }
}
