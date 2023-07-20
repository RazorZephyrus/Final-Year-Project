<?php

namespace App\Http\Resources\V1\Setting;

// use App\Http\Resources\V1\Pivot\FileInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SitesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $value = [];
        if (! empty($this->mainSetting) && ! empty($this->mainSetting->value)) {
            if (isset($this->mainSetting->value['recaptcha'])) {
                $value = $this->mainSetting->value;
            } else {
                $value = array_merge($this->mainSetting->value, ['recaptcha' => [
                    'key' => config('recaptcha.api_site_key'),
                    'secret' => config('recaptcha.api_secret_key'),
                ]]);
            }
        }
        return [
            'x-site' => $this->uuid,
            'sites' => $this->title,
            'description' => $this->description,
            'main_setting' => [
                'uuid' => $this->mainSetting->uuid,
                'slug' =>  $this->mainSetting->slug,
                'value' => $value,
            ],
            'is_enabled' => $this->is_enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
