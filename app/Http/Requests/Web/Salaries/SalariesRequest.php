<?php

namespace App\Http\Requests\Web\Salaries;

use Illuminate\Foundation\Http\FormRequest;

class SalariesRequest extends FormRequest
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
            'gaji_pokok' => 'required|numeric',
            'uang_beras' => 'required|numeric',
            'uang_makan' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'tunjangan' => 'required|numeric|min:0',
            'hutang' => 'required|numeric|min:0',
            'description' => 'nullable',
            'bulan' => 'required'
        ];
    }
}
