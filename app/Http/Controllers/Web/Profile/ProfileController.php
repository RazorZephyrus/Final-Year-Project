<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Modules\BaseInertiaCrud;
use App\Http\Requests\Web\Profile\ChangeProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseInertiaCrud
{

    public $model = User::class;

    public $updateValidator = ChangeProfileRequest::class;

    public $viewPath = 'pages.profile';

    public function index(Request $request)
    {
        $user = Auth::user();

        $data['row'] = $user;

        $data = $this->__extraDataShow($data);

        return view(
            $this->viewPath . ".index", $data
        );
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        return $this->update($request, $user->uuid);
    }
}
