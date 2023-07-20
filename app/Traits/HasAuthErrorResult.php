<?php

namespace App\Traits;

use Exception;

trait HasAuthErrorResult
{
    public function __errorLogin()
    {
        if(request('_token')) {
            return redirect(route('login'))->withErrors(['msg' => 'Invalid Credential']);
        }
        abort(403, "Invalid Credential");
    }

    public function __errUserNotFound()
    {
        abort(404, "User Not Found");
    }

    public function __errorForgotPassword()
    {
        $this->__errUserNotFound();
    }

    public function __errorResetPassword()
    {
        $this->__errUserNotFound();
    }

    public function __errorVerifyEmail()
    {
        $this->__errUserNotFound();
    }

    public function __errorVerifyResetPassword()
    {
        $this->__errUserNotFound();
    }
}
