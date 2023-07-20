<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Asrama\AsramaRequest;
use App\Models\Asramas;
use App\Services\UploadService;
use App\Constants\FileConst;
use Illuminate\Support\Str;

class AsramaController extends BaseWebCrud
{
    public $model = Asramas::class;
    public $viewPath = 'pages.asrama';

    public $storeValidator = AsramaRequest::class;
    public $updateValidator = AsramaRequest::class;
    public $uploaded = [];

    public function __prepareQueryList($query)
    {
        if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF)) {
            $query = $query->where('id', auth()->user()->asrama_id);
        }
        return $query;
    }

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.asrama.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function __beforeStore()
    {
        $uploadData = [];
        foreach ($this->requestData->file('images') as $key => $value) {
            $upload = new UploadService(
                $value,
                FileConst::IMAGE_ASRAMA_PATH,
                (string) Str::uuid()
            );

            $upload->uploadResize(300);
            $uploadData[] = $upload;
       }

        $this->uploaded = $uploadData;
    }

    public function __beforeUpdate()
    {
        $this->__beforeStore();
    }

    public function __afterUpdate()
    {
        if (!empty($this->uploaded)) {
            foreach ($this->uploaded as $key => $value) {
                $value->deleteFile($this->row->image());
            }
        }

        $this->__afterStore();
    }

    public function __afterStore()
    {

        if (!empty($this->uploaded)) {
            foreach ($this->uploaded as $key => $value) {
                $value->saveFile($this->row->image(), ['slug' =>  FileConst::IMAGE_ASRAMA_SLUG]);
            }
        }
    }
}
