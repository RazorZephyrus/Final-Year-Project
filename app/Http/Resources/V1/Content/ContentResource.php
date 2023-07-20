<?php

namespace App\Http\Resources\V1\Content;

// use App\Http\Resources\V1\Pivot\FileInfoResource;

use App\Constants\RuleConst;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $fields = $this->content->fields;
        $use_seo = $this->content->use_seo;
        
        $rel = [];
        $fieldFiles = [];
        foreach ($fields as $key => $value) {
            if($value['is_relation']) {
                $rel[strtolower($value['name'])] = $value;
            }

            if($value['type'] == 'image' || $value['type'] == 'file') {
                $fieldFiles[$value['name']] = $value;
            }
        }

        $fieldsValues = $this->value;

        if(!empty($rel)) {
            foreach ($rel as $key => $val) {
                if(isset($fieldsValues[$key]) AND is_array($fieldsValues[$key])) {
                    // foreach ($fieldsValues[$key] as $k => $v) {
                        $fieldsValues[$key] =  ContentResource::collection(\App\Models\ContentValue::withTrashed()->whereIn('id', $fieldsValues[$key])->get());
                    // }
                } else {
                    # handle For nullable Relation
                    if(isset($fieldsValues[$key])) {
                        $fieldsValues[$key] = new ContentResource(\App\Models\ContentValue::withTrashed()->where('id', $fieldsValues[$key])->first());
                    } else {
                        $fieldsValues[$key] = [];
                    }
                }
            }
        }

        foreach ($fieldsValues as $key => $value) {
            $file = $this->files()->where('title', $key)->first();
            if(isset($fieldFiles[$key]) AND !$fieldFiles[$key]['is_multiple'] AND ($fieldFiles[$key]['type'] == 'image' || $fieldFiles[$key]['type'] == 'file')) {
                // $fieldsValues[$key] = url()->to('files/show?url_real='.$fieldsValues[$key]);
                if (!empty($file) AND $fieldsValues[$key] != "") {
                    $fieldsValues[$key] = ($file->file?->storage == 'local') ? url()->to('files/show?url_real=' . $file->file?->url_real) : 'https://'.$file->file?->url;

                    if ($file->file?->storage == 'gcs') {
                        $fieldsValues[$key] = 'https://storage.googleapis.com/'.$file->file?->url;
                    }
                } else {
                    $fieldsValues[$key] = null;
                }

                if(!empty($file)) {
                    $fieldsValues[$key] = ($file->file?->storage == 'local') ? url()->to('files/show?url_real='.$file->file?->url_real) : 'https://'.$file->file?->url;

                    if ($file->file?->storage == 'gcs') {
                        $fieldsValues[$key] = 'https://storage.googleapis.com/'.$file->file?->url;
                    }
                }
            }
        }

        if($use_seo == true) {
            $seo = RuleConst::SEO;
    
            foreach($seo as $key => $value) {
                if(!isset($fieldsValues[$value]) OR empty($fieldsValues[$value])) {
                    $fieldsValues[$value] = $this->title;
                    if($value == 'seo_keywords') {
                        $fieldsValues[$value] = [$this->title];
                    } elseif ($value == 'seo_op_image' || $value == 'seo_twitter_image') {
                        $file = $this->files()->where('title', $value)->first();
                        if(!empty($file)) {
                            $fieldsValues[$value] = ($file->file?->storage == 'local') ? url()->to('files/show?url_real='.$file->file?->url_real) : 'https://'.$file->file?->url;
    
                            if ($file->file?->storage == 'gcs') {
                                $fieldsValues[$value] = 'https://storage.googleapis.com/'.$file->file?->url;
                            }
                        } else {
                            $fieldsValues[$value] = url()->to('files/show?url_real=/default/icons.png');
                        }
                    }
                } else {
                    if($value == 'seo_op_image' || $value == 'seo_twitter_image') {
                        $file = $this->files()->where('title', $value)->first();
                        if(!empty($file)) {
                            $fieldsValues[$value] = ($file->file?->storage == 'local') ? url()->to('files/show?url_real='.$file->file?->url_real) : 'https://'.$file->file?->url;
    
                            if ($file->file?->storage == 'gcs') {
                                $fieldsValues[$value] = 'https://storage.googleapis.com/'.$file->file?->url;
                            }
                        } else {
                            $fieldsValues[$value] = url()->to('files/show?url_real=/default/icons.png');
                        }
                    }
                }
            }
        }

        return [
            'id' => $this->uuid,
            'site' => $this->content->site->title,
            'is_main_page' => $this->content->main_page,
            'status' => $this->status,
            'title' => $this->title,
            'slug' => $this->slug,
            'data_extra' => $this->content->data_extra,
            'content_type_title' => $this->content->title,
            'content_type_slug' => $this->content->slug,
            'fieldsValues' => $fieldsValues,
//            'file' => $this->file,
//            'files' => $this->files,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
