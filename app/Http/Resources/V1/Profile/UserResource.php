<?php

namespace App\Http\Resources\V1\Profile;

use App\Http\Resources\V1\Pivot\FileInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'addresses' =>   AddressResource::collection($this->whenLoaded('addresses')),
            'avatar' =>  new FileInfoResource($this->whenLoaded('avatar')),
        ];
    }
}
