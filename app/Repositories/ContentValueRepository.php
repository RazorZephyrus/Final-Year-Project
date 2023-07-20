<?php

namespace App\Repositories;

use App\Models\Content;
use App\Models\ContentField;
use App\Models\ContentValue;
use App\Models\File;
use App\Repositories\BaseRepository;
use App\Repositories\FileRepository;
use Faker\Core\Number;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContentValueRepository extends BaseRepository
{
    public function saveImage($row, $file, string $fileName = null, $slug = 'content-value-files')
    {
        if ($fileName == null) {
            $fileName = $row->uuid;
        }
        $uploadService = new \App\Services\UploadService($file, 'content-values', $fileName);
        $uploaded = $uploadService->upload();

        return FileRepository::preps($row, 'file', $uploaded, $slug);
    }

    public function getContentType($model, $slug, $relation = false)
    {
        $data = $model::where('slug', $slug)->where('site_id', session()->get('site')->id);
        if ($relation) {
            $data = $data->with(['contentValues']);
        }

        $data = $data->firstOrFail();

        if (session()->get('site')->id != $data->site_id) {
            abort(401, 'session site not found');
        }

        return $data;
    }

    public function storeContent($data, $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $slug = 'content-values-' . $data->slug . '-' . $data->id . date('is');
            if (isset($input['title']) and empty($input['slug'])) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['title'])));
            }

            if (isset($input['name']) and empty($input['slug'])) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['name'])));
            }

            if (!empty($input['slug'])) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['slug'])));
            }

            unset($input['_token']);
            unset($input['slug']);
            unset($input['_method']);

            $checkSlug = $data->contentValues()->where('slug', $slug)->count();
            if ($checkSlug > 0) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data->slug . '-' . date('is'))));
            }

            foreach ($input as $key => $value) {
                if ($value == "false") {
                    $input[$key] = false;
                }

                if ($value == "true") {
                    $input[$key] = true;
                }
            }

            $contentValue = ContentValue::create([
                'title' => $input['title'],
                'slug' => $slug,
                'status' => $input['status'],
                'value' => $input,
                'content_id' => $data->id
            ]);

            if ($request->allFiles()) {
                foreach ($request->allFiles() as $key => $value) {
                    $this->saveImage($contentValue, $value, $contentValue->uuid . '--' . $key, $key); // strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data->title . ' ' . $key))));
                }
            }
            DB::commit();
            return ['status' => true, 'msg' => ''];
        } catch (\Throwable $th) {

            DB::rollBack();
            return ['status' => false, 'msg' => $th];
        }
    }

    public function updateContent($data, $request, $id)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();

            $row = $data->contentValues()->where('uuid', $id)->with(['file'])->firstOrfail();
            $fields = $row->content->fields;
            $slug = $row->slug;

            if (!empty($input['slug'])) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['slug'])));
            }

            $checkSlug = $data->contentValues()->where('id', '!=', $row->id)->where('slug', $slug)->count();
            if ($checkSlug > 0) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data->slug . '-' . date('is'))));
            }

            unset($input['_token']);
            unset($input['_method']);
            unset($input['slug']);

            $fieldFile = ['seo_op_image' => null, 'seo_twitter_image' => null];

            foreach ($fields as $key => $value) {
                if (!$value['is_multiple'] and ($value['type'] == 'image' or $value['type'] == 'file') and $row->file != null) {
                    $fieldFile[$value['name']] = $row->file->file->url_real;
                } elseif (($value['type'] == 'image' or $value['type'] == 'file') and $row->file == null) {
                    $fieldFile[$value['name']] = null;
                }
            }

            if ($request->allFiles()) {
                //                foreach ($row->files as $filePivot) {
                //                    $filePivot->file->delete();
                //                    $filePivot->delete();
                //                }
                foreach ($fieldFile as $key => $value) {
                    $files = $request->allFiles();
                    if(isset($files[$key]) == true) {
                        $filePivot = $row->files()->where('title', strtolower($key))->first();
                        if (!empty($filePivot)) {
                            $fileDelete = $row->files()->with(['file'])->where('title', strtolower($key))->first();
                            $fileDelete->file->delete();
                            $fileDelete->delete();
                        }
                        $this->saveImage($row, $request->allFiles()[$key], $row->uuid . '--' . $key, $key); // strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data->title . ' ' . $key))));
                    } else {
                        $input[$key] = isset($row->file->file->url_real) ?? null;
                    }

                }

            } else {
                foreach ($fields as $key => $value) {
                    if (!$value['is_multiple'] and ($value['type'] == 'image' OR $value['type'] == 'file')) {
                        $input[$value['name']] = $row->file?->file?->url_real;
                    }
                }
            }

            foreach ($input as $key => $value) {
                if ($value == "false") {
                    $input[$key] = false;
                }

                if ($value == "true") {
                    $input[$key] = true;
                }

                if (is_numeric($value)) {
                    $input[$key] = (int) $value;
                }
            }

            $contentValue = $row->update([
                'title' => $input['title'],
                'slug' => $slug,
                'status' => $input['status'],
                'value' => $input,
                'content_id' => $data->id
            ]);

            DB::commit();
            return ['status' => true, 'msg' => ''];
        } catch (\Throwable $th) {

            DB::rollBack();
            return ['status' => false, 'msg' => $th];
        }
    }

    public function showResultByContentType($data)
    {
        $result = [];
        if ($data) {
            foreach ($data as $key => $value) {
                $result[$value->content->slug]['title'] = $value->content->title;
                $result[$value->content->slug]['content_slug'] = $value->content->title;
                $result[$value->content->slug]['data_values'][] = ['uuid' => $value->uuid, 'content_type' => $value->content->title, 'slug' => $value->slug, 'title' => $value->title];
            }
        }

        return $result;
    }

    public function validateInput($request, $contentData, $row = null)
    {
        if (!empty($contentData) && !empty($contentData->fields)) {
            $fields = $contentData->fields;
            $fields = collect($fields);
            $validatorRule = [];
            foreach ($fields as $field) {
                $rules = [];
                if ($row == null) {
                    if ($field['is_required'] ) {
                        $rules[] = 'required';
                    }
                } else {
                    if ($field['is_required']) {
                        $filePivot = $row->files()->where('title', strtolower($field['name']))->first();
                        if (empty($filePivot)) {
                            $rules[] = 'required';
                        }
                    }
                }
                if ($field['type'] == 'date') {
                    $rules[] = 'date';
                }
                if ($field['type'] == 'number') {
                    $rules[] = 'numeric';
                }
                if ($field['type'] == 'image') {
                    $rules[] = 'image';
                }
                if ($field['type'] == 'file') {
                    $rules[] = 'file';

                    if (!empty($field['accept']) AND $field['accept'] != 'image/*'
                    AND $field['accept'] != 'video/*' AND $field['accept'] != 'audio/*') {
                        $rules[] = 'mimes:' . str_replace('.', '', $field['accept']);
                    } elseif (!empty($field['accept']) AND $field['accept'] == 'image/*') {
                        $rules[] = 'mimes: jpg,png,bmp,jpeg,gif';
                    } elseif (!empty($field['accept']) AND $field['accept'] == 'video/*') {
                        $rules[] = 'mimes: mp4,flv,3gp,avi,wmv,mov';
                    } elseif (!empty($field['accept']) AND $field['accept'] == 'audio/*') {
                        $rules[] = 'mimes: mp3,aac,mpeg,mp4,mid,midi,wav,webm';
                    }
                }
                if (isset($field['min'])) {
                    $rules[] = 'min:' . $field['min'];
                }
                if (isset($field['max'])) {
                    $rules[] = 'max:' . $field['max'];
                }
                $validatorRule[strtolower($field['name'])] = $rules;
            }

            $validator = Validator::make($request->all(), $validatorRule);

            return $validator;
        }
    }
}
