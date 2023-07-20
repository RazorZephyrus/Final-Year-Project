<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('id'), 'uuid')],
            'username' => 'nullable',
            'role' => 'required|exists:roles,name',
            'is_enabled' => 'required',
            'password' => '',
            'password_confirm' => '',
            'nik' => 'nullable',
            'fakultas' => 'nullable',
            'gender' => 'required',
            'asrama_id' => 'nullable',
        ];
    }
}
