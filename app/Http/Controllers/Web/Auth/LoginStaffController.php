<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Modules\BaseAuth;
use App\Http\Requests\Web\Auth\AuthLoginStaff;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Http\Requests\Web\Auth\AuthLoginStaffOtp;
// use Throwable;
// use Twilio;
class LoginStaffController extends BaseAuth
{
    public $validatorLogin = AuthLoginStaff::class;
    public $validatorOtp = AuthLoginStaffOtp::class;

    private $repo;

    public function __construct()
    {
        $this->repo = new AuthRepository;
    }

    public function stafValidate(Request $request) {
        $req = app($this->validatorLogin);
        $this->requestData = $req;

        $query = Employee::query()->with(['user']);
        $phone_or_email = $this->requestData->input("phone_or_email");
        if (is_numeric($phone_or_email)) {
            $firstCheck = substr($phone_or_email, 0, 1);
            if ($firstCheck != 8) {
                if ($firstCheck == '6') {
                    $phone_or_email = substr_replace($phone_or_email, '', 0, 2);
                } elseif ($firstCheck == '0') {
                    $phone_or_email = "0".substr_replace($phone_or_email, '', 0, 1);
                }
            }
            $query->where('phone', $phone_or_email);
        } else {
            $query->where(
                'email',
                strtolower($request->input('phone_or_email'))
            );
        }

        $employee = $query->whereHas('user', function($q) {
            $q->where('is_enabled', 1);
        })->firstOrFail();
        // TODO save code OTP to table OTP
        // do login 
        $code = rand(10000, 99999);
        $employee->user()->update(["code_otp" => $employee->id.$code]);

        // funtion for send otp
        // $send = $this->sendSmsOtp($employee->id.$code, $phone_or_email);
        // if(!$send) {
        //     dd("ERROR SENDING...");
        // }
        
        return redirect(route("login_staf_otp", ['employee_uuid' => $employee->uuid]));
    }

    public function sendSmsOtp($code, $phone)
    {
        // $message = "Login OTP is ".$code;
        // try {
        //     $phoneNumber = "+62".substr_replace($phone, '', 0, 1)
        //     Twilio::message($phoneNumber, $message);
    
        // } catch (Throwable $e) {
        //     return false;
        // }

        // return true;
    }

    public function stafValidateOtp($employee_uuid, Request $request) {
        $req = app($this->validatorOtp);
        $this->requestData = $req;
        // TODO save code OTP to table OTP
        // do login 
        // Dummy OTP 
        $opt = $this->requestData->get("code_otp");
        $query = Employee::query()->with(['user'])->where("uuid", $employee_uuid)->whereHas('user', function($q) use ($opt) {
            $q->where('code_otp', $opt);
        });
        $ress = $query->first();
        Auth::login($ress->user);
        $removeotp = $ress->user();
        $removeotp->update(["code_otp" => null]);
        return redirect(route("web.dashboard"));
    }

    public function stafRenewOtp($employee_uuid) {
        // TODO save code OTP to table OTP
        // do login 
        // Dummy OTP 
        $query = Employee::query()->with(['user'])->where("uuid", $employee_uuid);
        $ress = $query->first();

        $code = rand(10000, 99999);
        $code = $ress->id.$code;
        $ress->user()->update(["code_otp" => $code]);

        // funtion for send otp
        // $send = $this->sendSmsOtp($code, $ress->phone);
        // if(!$send) {
        //     dd("ERROR SENDING...");
        // }

        return redirect(route("login_staf_otp", ['employee_uuid' => $employee_uuid]));
    }
}
