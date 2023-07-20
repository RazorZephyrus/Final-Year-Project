<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Fasilitas\FasilitasRequest;
use App\Models\Fasilitas;

class FasilitasController extends BaseWebCrud
{
    public $model = Fasilitas::class;
    public $viewPath = 'pages.fasilitas';

    public $storeValidator = FasilitasRequest::class;
    public $updateValidator = FasilitasRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.fasilitas.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }
}
