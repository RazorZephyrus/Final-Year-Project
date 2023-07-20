<?php

namespace App\Repositories\Auth;

use App\Constants\TokenConstant;
use App\Notifications\SuccessResetPassword;
use App\Repositories\Base\TokenRepository;
use App\Repositories\BaseRepository;


class ResetPasswordRepository extends BaseRepository
{
    public function notifyAfterResetPassword($user)
    {
        $tokenRepo = new TokenRepository;

        $tokenRepo->revokeTokens($user, TokenConstant::VERIFY_RESET_PASSWORD);

        $user->notify(new SuccessResetPassword());
    }
}
