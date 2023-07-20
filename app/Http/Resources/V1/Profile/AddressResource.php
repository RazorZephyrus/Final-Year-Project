<?php

namespace App\Http\Resources\V1\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'address' => $this->address,
            'is_default' => $this->is_default,
            'country_id' => $this->country_id,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'suburb_id' => $this->suburb_id,
            'area_id' => $this->area_id,

            'country_name' => $this->country_name,
            'province_name' => $this->province_name,
            'city_name' => $this->city_name,
            'suburb_name' => $this->suburb_name,
            'area_name' => $this->area_name,
            'postcode' => $this->postcode,
            'display_address' => $this->display_address,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
