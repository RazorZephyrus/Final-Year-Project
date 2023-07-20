<?php

namespace App\Traits;

trait HasAuthSuccessResult
{

    public function __success()
    {
        if(request('_token')) {
            return redirect(route('web.dashboard'));
        }
        return ['token' => $this->user->createToken('personal')->accessToken];
    }


    public function __successLogin()
    {
        return $this->__success();
    }


    public function __successRegister()
    {
        return $this->__success();
    }

    public function __successLogout()
    {
        if(request('_token')) {
            return redirect('/landing');
        }
        return ['success' => true];
    }

    public function __successResetPassword()
    {
        return ['success' => true];
    }

    public function __successVerifyEmail()
    {
        return ['success' => true];
    }

    public function __successForgotPassword()
    {
        return ['success' => true];
    }

    public function __successVerifyResetPassword()
    {
        return ['success' => true];
    }
}
