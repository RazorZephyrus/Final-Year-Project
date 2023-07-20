<?php

namespace App\Http\Controllers\Web\Profile;

use App\Constants\FileUploadConst;
use App\Http\Modules\BaseInertiaCrud;
use App\Http\Requests\Web\Profile\ChangeAvatarRequest;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Constants\FileConst;

class ChangeAvatarController extends BaseInertiaCrud
{

    public $model = User::class;

    public $updateValidator = ChangeAvatarRequest::class;

    public $viewPath = 'Profile/ChangeAvatar';

    public function index(Request $request)
    {
        $user = Auth::user();
        return $this->edit($user->uuid);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        return $this->update($request, $user->uuid);
    }

    public function __beforeUpdate()
    {
        $upload = new UploadService(
            $this->requestData->file('avatar'),
            FileConst::USER_AVATAR_PATH,
            Auth::user()->uuid
        );

        $upload->uploadResize(300);

        $this->uploaded = $upload;
    }

    public function __afterupdate()
    {

        if ($this->uploaded) {
            $this->uploaded->saveFileInfo($this->row->avatar(), ['slug' =>  FileConst::USER_AVATAR_SLUG]);
        }
    }
}
