<?php

namespace App\Http\Requests\Web\Employee;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $employee = Employee::getFirst($this->route('id')) ?? null;
        $userId = $employee ? $employee->user?->id : 0;
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$userId.',id',
            'nip' => 'required|unique:employees,nip,'.$employee?->id.',id',
            'tempat' => 'nullable',
            'unit_kerja_id' => 'required|exists:unit_kerja,uuid',
            'dob' => 'nullable',
            'alias' => 'nullable',
            'gender' => 'nullable',
            'phone' => 'nullable',
            'avatar' => 'nullable',
        ];
    }
}
