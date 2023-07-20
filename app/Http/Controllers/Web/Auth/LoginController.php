<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Modules\BaseAuth;
use App\Http\Requests\Web\Auth\AuthLogin;
use App\Repositories\Auth\AuthRepository;

class LoginController extends BaseAuth
{
    public $validatorLogin = AuthLogin::class;

    private $repo;

    public function __construct()
    {
        $this->repo = new AuthRepository;
    }

    public function __prepareQueryLogin($query)
    {
        $request = $this->requestData;

        return $this->repo->queryLogin($query, $request, true);
    }

    public function __successLogout()
    {
        session()->flush();
        return parent::__successLogout();
    }
}
