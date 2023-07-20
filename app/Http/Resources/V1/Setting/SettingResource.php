<?php

namespace App\Http\Resources\V1\Setting;

// use App\Http\Resources\V1\Pivot\FileInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ress = [];

        foreach($this->value as $key => $row) {
            $ress[$key] = $row;
            if(isset($row['mobile_icon']) AND !empty($row['mobile_icon'])) {
                if(!str_starts_with($row['mobile_icon'], 'http')) {
                    $image = explode('uploads', $row['mobile_icon']);
                    $ress[$key]['mobile_icon'] = url()->to('files/show?url_real=' . $image[1]);
                }
            }

            if(isset($row['web_icon']) AND !empty($row['web_icon']) ) {
                if(!str_starts_with($row['web_icon'], 'http')) {
                    $image = explode('uploads', $row['mobile_icon']);
                    $ress[$key]['web_icon'] = url()->to('files/show?url_real=' . $image[1]);
                }
            }

            if(isset($row['label']) AND $row['label'] == 'Social Media' AND isset($row['child'])) {
                foreach ($row['child'] as $kc => $kv) {
                    if(isset($kv['icon']) && !str_starts_with($kv['icon'], 'http')) {
                        $image = explode('uploads', $kv['icon']);
                        // $ress[$key]['web_icon'] = url()->to('files/show?url_real=' . $image[1]);
                        $ress[$key]['child'][$kc]['icon'] = url()->to('files/show?url_real=' . $image[1]);
                    }
                }
            }
        }

        if(!empty(request()->get('show_mobile')) AND !empty($ress)) {
            if(request()->get('show_mobile') == 'false') {
                $show_mobile = [];
                foreach ($ress as $key => $value) {
                    if(isset($value['show_mobile']) && $value['show_mobile'] == false) {
                        $show_mobile[] = $value;
                    }
                }
            } else {
                $show_mobile = [];
                foreach ($ress as $key => $value) {
                    if(isset($value['show_mobile']) && $value['show_mobile'] == true) {
                        $show_mobile[] = $value;
                    }
                }
            }

            $ress = $show_mobile;
        }

        return [
            'id' => $this->uuid,
            'site' => $this->site->title,
            'menus' => $ress,
            'is_enabled' => $this->is_enabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
