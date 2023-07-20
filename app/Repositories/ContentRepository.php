<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\ContentField;
use App\Repositories\BaseRepository;
use App\Repositories\FileRepository;
use Illuminate\Validation\ValidationException;

class ContentRepository extends BaseRepository
{
    public function saveImage($row, $file, string $fileName = null)
    {
        if ($fileName == null) {
            $fileName = $row->uuid;
        }
        $uploadService = new \App\Services\UploadService($file, $row->slug, $fileName);
        $uploaded = $uploadService->upload();

        FileRepository::preps($row, 'icon', $uploaded, Content::ICON_CONTENT);
    }

    public function validateFieldsJson($req)
    {
        $keyJson = [
            'name', 'type', 'length', 'is_required', 'is_multiple', 'is_relation', 'relation_with'
        ];
        $fields = json_decode($req, true);
        foreach ($fields as $key => $value) {
            foreach ($keyJson as $k) {
                if (!isset($value[$k])) {
                    throw ValidationException::withMessages(['message' => "Fields Not Valid: Fields ->" . $key . " - " . $k]);
                }
            }
        }
    }

    public function createField($fields, $data)
    {
        foreach ($fields as $key => $value) {
            ContentField::create([
                "content_id" => $data->id,
                "name" => strtolower($value['name']),
                "type" => $value['type'],
                "length" => $value['length'],
                "info" => isset($value['info']) ? json_encode($value['info']) : null,
                "is_required" => $value['is_required'],
                "is_multiple" => $value['is_multiple'],
                "is_relation" => $value['is_relation'],
                "relation_with" => is_array($value['relation_with']) ? implode("&&", array_map(function ($a) {
                    return implode("~", $a);
                }, $value['relation_with'])) : $value['relation_with'],
            ]);
        }
    }
}
