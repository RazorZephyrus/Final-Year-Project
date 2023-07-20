<?php

namespace App\Http\Requests\Api\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;


class ApiAddrressRequest extends FormRequest
{

    protected function prepareForValidation()
    {

        $this->merge([
            'is_default' =>  request()->input('is_default', false)
        ]);
    }

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
            'address' => 'required|max:300',
            
            'is_default' => 'required|boolean',

            'country_id' => 'required|numeric|min:1',
            'province_id' => 'required|numeric|min:1',
            'city_id' => 'required|numeric|min:1',
            'suburb_id' => 'required|numeric|min:1',
            'area_id' => 'required|numeric|min:1',

            'country_name' => 'required|max:150',
            'province_name' => 'required|max:150',
            'city_name' => 'required|max:150',
            'suburb_name' => 'required|max:150',
            'area_name' => 'required|max:150',
            'postcode' => 'required|max:10',
            'display_address' => 'required|max:1000', 
        ];
    }
}
