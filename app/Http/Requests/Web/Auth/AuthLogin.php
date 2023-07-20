<?php

namespace App\Http\Requests\Web\Auth;

use App\Services\NexmoService;
use Illuminate\Foundation\Http\FormRequest;

class AuthLogin extends FormRequest
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
            /**
             * @OA\Parameter(
             *   parameter="AuthLogin_phone_or_email",
             *   name="email",
             *   @OA\Schema(
             *     type="string"
             *   ),
             *   in="query",
             *   required=true
             * )
             */
            'email' => 'required',

            /**
             * @OA\Parameter(
             *   parameter="AuthLogin_password",
             *   name="password",
             *   @OA\Schema(
             *     type="string"
             *   ),
             *   in="query",
             *   required=true
             * )
             */
            'password' => 'required',
        ];
    }
}
