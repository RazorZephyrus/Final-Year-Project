<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\FilePivot;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileRepository extends BaseRepository
{

    public static function preps($obj, $relation, $uploaded, $slug)
    {
        $pivot = new FilePivot(); // $obj->$relation ?? new FilePivot();

        $file = new File(); // $pivot->file ?? new File;

        $self = new FileRepository;
        $file = $self->prepFile($file, $uploaded);
        return $self->prepPivot($file, $pivot, $obj, $obj->$relation(), $relation, $slug);
    }

    public function prepFile(File $file, $uploaded)
    {

        $file->fill([
            'url_real' => $uploaded['uploaded_path'],
            'url' => $uploaded['uploaded_url'],
            'extension' => $uploaded['original_extension'],
            'size' => $uploaded['uploaded_size'],
            'storage' => $uploaded['uploaded_disk']
        ]);

        $file->save();

        return $file;
    }

    public function prepPivot(File $file, FilePivot $pivot, $relation, $relation_func, $relationship = '', $title = null, $index = 0, $description = null)
    {
        $pivot->fill([
            'relationship' => $relationship,
            'index' => $index,
            'title' => $title ?? $relationship,
            'description' => $description ?? $title ?? $relationship,
            'file_id' => $file->id,
            'ref_model' => $relation->getMorphClass(),
            'ref_table' => $relation->getTable()
        ]);

        return $relation_func->save($pivot);
    }

    public static function deleteFiles($files)
    {
        $url = $files['url_real'];
        $url = explode('=', $url);
        if(isset($url[1])) {
            $path = storage_path() . '/app/' . $url[1];

            Storage::delete($path);
        }
        return true;
    }
}
