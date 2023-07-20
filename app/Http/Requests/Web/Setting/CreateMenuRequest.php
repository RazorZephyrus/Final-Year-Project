<?php

namespace App\Http\Requests\Web\Setting;

use Illuminate\Foundation\Http\FormRequest;


class CreateMenuRequest extends FormRequest
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
            'label' => 'required',
            'link' => 'required',
            'web_icon' => '',
            'mobile_icon' => '',
            'show_web' => '',
            'show_mobile' => '',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $val = parent::validated($key, $default);
        $val['show_web'] = (isset($val['show_web']) && $val['show_web'] == 'on');
        $val['show_mobile'] = (isset($val['show_mobile']) && $val['show_mobile'] == 'on');
        return $val;
    }
}
