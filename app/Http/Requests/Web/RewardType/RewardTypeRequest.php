<?php

namespace App\Http\Requests\Web\RewardType;

use Illuminate\Foundation\Http\FormRequest;

class RewardTypeRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable',
            'is_enabled' => 'numeric|min:0|max:1',
        ];
    }
}
