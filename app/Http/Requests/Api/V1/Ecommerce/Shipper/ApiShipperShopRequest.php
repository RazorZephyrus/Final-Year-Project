<?php

namespace App\Http\Requests\Api\V1\Ecommerce\Shipper;


use Illuminate\Foundation\Http\FormRequest;

class ApiShipperShopRequest extends FormRequest
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
            'shop' => 'required|array',
            'shop.seller_id' => 'required|exists:sellers,uuid',
            'shop.items' => 'required|array',
            'shop.items.*.product_id' => 'required|exists:products,uuid',
            'shop.items.*.quantity' => 'required|integer|min:1',
        ];
    }
}
