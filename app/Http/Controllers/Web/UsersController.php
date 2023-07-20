<?php

namespace App\Http\Controllers\Web;

use App\Exports\UsersExport;
use App\Http\Modules\BaseWebCrud;
use App\Models\User;
use App\Http\Requests\Web\RewardType\RewardTypeRequest;
use App\Http\Requests\Web\User\UserNewRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Web\User\UserEditRequest;
use App\Models\Asramas;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends BaseWebCrud
{
    public $model = User::class;
    public $viewPath = 'pages.users'; // tampilan

    public $storeValidator = UserNewRequest::class;
    public $updateValidator = UserEditRequest::class;

    public function __prepareDataStore($data) 
    {
        if(isset( $data['asrama_id']) and $data['asrama_id'] != null){

            $data['asrama_id'] = Asramas::getId($data['asrama_id']);
        }
        $data['password'] = Hash::make($data['password']);
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.users.index'));
    }

    public function __afterStore()
    {
        $this->row->assignRole($this->requestData->input('role'));
    }

    public function __prepareDataUpdate($data)
    {
        if($data['password'] != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        if(isset( $data['asrama_id']) and $data['asrama_id'] != null){

            $data['asrama_id'] = Asramas::getId($data['asrama_id']);
        }
        
        return $data;
    }

    public function __successUpdate()
    {
        if(auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN)) {
            return $this->__successStore();
        }
        return redirect(url()->previous());
    }

    public function __afterUpdate()
    {
        $this->__afterStore();
    }

    public function export() {
        return Excel::download(new UsersExport, 'Users-'.date('YmdHis').'.xlsx');
    }

    public function __beforeDestroy() {
        $data = $this->row;
        $data->update(['nik' => 'deleted-'.date('dmyHis'), 'email' => $this->row->email.'-deleted-'.date('dmyHis')]);
    }
}
