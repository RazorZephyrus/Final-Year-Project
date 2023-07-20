<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait HasAuthPrepareQuery
{

    public function __prepareGetUser($query)
    {
        $request = $this->requestData;
        $query->where('email', strtolower($request->input('email')));
        return $query;
    }

    public function __prepareQueryLogin($query)
    {
        $this->__prepareGetUser($query);
    }

    public function __prepareDataRegister($data)
    {
        if (!empty($data['email'])) {
            $data['email'] = strtolower($data['email']);
        }
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    public function __prepareQueryForgotPassword($query)
    {
        $this->__prepareGetUser($query);
    }

    public function __prepareQueryVerifyResetPassword($query)
    {
        $this->__prepareGetUser($query);
    }

    public function __prepareQueryResetPassword($query)
    {
        $this->__prepareGetUser($query);
    }

    public function __prepareQueryVerifyEmail($query)
    {
        $this->__prepareGetUser($query);
    }

    public function __prepareDataResetPassword($data)
    {
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    public function __prepareDataVerifyEmail()
    {
        return [];
    }
}
