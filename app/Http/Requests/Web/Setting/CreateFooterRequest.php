<?php

namespace App\Http\Requests\Web\Setting;

use Illuminate\Foundation\Http\FormRequest;

class CreateFooterRequest extends FormRequest
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
            'child' => '',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $val = parent::validated($key, $default);
        if (isset($val['child'])) {
            $valChild = [];
            if (isset($val['child']['label']) && is_array($val['child']['label'])) {
                for ($i = 0; $i < count($val['child']['label']); $i++) {
                    $valChild[] = [
                        'label' => $val['child']['label'][$i],
                        'link' => $val['child']['link'][$i],
                        'icon' => $val['child']['icon'][$i],
                    ];
                }
            } else if (isset($val['child']['value'])) {
                $valChild = [
                    'value' => $val['child']['value'],
                ];
            } else {
                $valChild = [];
            }
            $val['child'] = $valChild;
        }
        return $val;
    }
}
