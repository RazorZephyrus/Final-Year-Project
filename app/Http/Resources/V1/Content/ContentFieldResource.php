<?php

namespace App\Http\Resources\V1\Content;

// use App\Http\Resources\V1\Pivot\FileInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentFieldResource extends JsonResource
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
            'site' => $this->content->site->title,
            'content_type' => $this->content->slug,
            'name' => $this->name,
            'type' => $this->type,
            'length' => $this->length,
            'is_required' => $this->is_required,
            'is_multiple' => $this->is_multiple,
            'is_relation' => $this->is_relation,
            'relation_with' => $this->relation_with,

            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
