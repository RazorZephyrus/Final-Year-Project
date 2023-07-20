<?php

namespace App\Http\Requests\Web\Auth;

use App\Services\NexmoService;
use Illuminate\Foundation\Http\FormRequest;

class AuthLoginStaffOtp extends FormRequest
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
            'code_otp' => 'required|exists:users,code_otp',
        ];
    }
}
