<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Models\Settings;
use App\Http\Requests\Web\Settings\SettingsRequest;

class SettingController extends BaseWebCrud
{
    public $model = Settings::class;
    public $viewPath = 'pages.setting';

    public $storeValidator = SettingsRequest::class;
    public $updateValidator = SettingsRequest::class;

    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.settings.index'));
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
