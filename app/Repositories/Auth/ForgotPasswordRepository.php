<?php

namespace App\Repositories\Auth;

use App\Constants\TokenConstant;
use App\Models\Base\Token;
use App\Notifications\VerifyResetPassword;
use App\Repositories\Base\TokenRepository;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ForgotPasswordRepository extends BaseRepository
{
    public function sendNotifForgotPassword($user)
    {
        $random = rand(1001, 9999);

        $tokenRepo = new TokenRepository;
        $tokenRepo->revokeTokens($user, TokenConstant::VERIFY_RESET_PASSWORD);

        $token = Token::create([
            'user_id' => $user->id,
            'token' => $random,
            'purpose' => TokenConstant::VERIFY_RESET_PASSWORD,
            'expired_at' => Carbon::now()->addMinutes(5)->toDateTimeString(),
        ]);

        $token->update(['key' =>  Str::random(20) . '-' . $token->id]);

        $user->notify(new VerifyResetPassword($token));

        return true;
    }
}
