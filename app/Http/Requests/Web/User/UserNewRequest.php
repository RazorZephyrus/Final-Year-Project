<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;


class UserNewRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required',
            'role' => 'required|exists:roles,name',
            'email' => 'required|email|unique:users,email,except,uuid',
            'is_enabled' => 'required',
            'asrama_id' => 'nullable',
            'password' => 'required|min:6',
            'password_confirm' => 'required|min:6|same:password',
            'nik' =>  'required_if:role,==,'.\App\Constants\RoleConst::STUDENT,
            'fakultas' => 'required_if:role,==,'.\App\Constants\RoleConst::STUDENT,
            'gender' => 'required',
        ];
    }
}
