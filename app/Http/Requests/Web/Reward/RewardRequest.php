<?php

namespace App\Http\Requests\Web\Reward;

use Illuminate\Foundation\Http\FormRequest;

class RewardRequest extends FormRequest
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
            'code' => 'required',
            'reward_type_id' => 'required|exists:reward_type,uuid',
            'point' => 'required|numeric|min:0|max:9999',
            'unit' => 'required',
        ];
    }
}
