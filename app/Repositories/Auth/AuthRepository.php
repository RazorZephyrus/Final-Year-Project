<?php

namespace App\Repositories\Auth;

use App\Constants\Role;
use App\Constants\Token as ConstantsToken;
use App\Models\Token;
use App\Notifications\SuccessResetPassword;
use App\Notifications\VerifyResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

use App\Models\Address;
use App\Models\AddressPivot;
use App\Models\Commerce\Customer;
use App\Models\Regency;
use App\Models\User;
use App\Repositories\TokenRepository;
use Illuminate\Support\Facades\Hash;


class AuthRepository extends BaseRepository
{

    public function queryLogin($query, $request, $is_mobile = false)
    {
        $query->where(function ($q) use ($request) {
            $email = strtolower($request->input('email'));
            $q->where('email', $email);
        })->where('is_enabled', true);

        return $query;
    }

    public function attemptWebLogin($request)
    {
        $query = User::query();

        $this->queryLogin($query, $request);

        $user = $query->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            return $user;
        }

        return false;
    }

    public function queryStaff($request)
    {
        $query = User::query();

        $this->queryLogin($query, $request);

        $user = $query->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            return $user;
        }

        return false;
    }
}
