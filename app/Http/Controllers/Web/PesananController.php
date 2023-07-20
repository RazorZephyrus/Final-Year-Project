<?php

namespace App\Http\Controllers\Web;

use App\Constants\FileConst;
use App\Constants\RoleConst;
use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\Pesanan\PesananRequest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Support\Str;


class PesananController extends BaseWebCrud
{
    public $model = Booking::class;
    public $viewPath = 'pages.pesanan';

    public $storeValidator = PesananRequest::class;
    public $updateValidator = PesananRequest::class;

    public $uploaded;

    public function __prepareQueryList($query)
    {
        if(auth()->user()->hasRole(RoleConst::STUDENT)) {
            $query = $query->where('user_id', auth()->user()->id);
        }

        if (auth()->user()->hasRole(RoleConst::STUDENT) AND request('is_student')) {
            $query = $query->whereIn('status', [$this->model::VERIFIED, $this->model::FAILED]);
        }
        return $query;
    }
    
    public function __beforeUpdate()
    {
        $upload = new UploadService(
            $this->requestData->file('image'),
            FileConst::PAYMENT_SLUG,
            (string) Str::uuid()
        );

        $upload->uploadResize(300);
        $uploadData = $upload;

        $this->uploaded = $uploadData;
    }
    public function __afterUpdate()
    {
        $this->row->update(['status' => 1]);
        
        $this->row->Payment()->create(
            ['ammount' => $this->toInt($this->requestData->input('ammount')), 'status' => 1]
        );
        $this->uploaded->saveFile($this->row->image(), ['slug' =>  FileConst::PAYMENT_SLUG]);
    }
    function toInt($str)
    {
        return (int)preg_replace("/\..+$/i", "", preg_replace("/[^0-9\.]/i", "", $str));
    }
    public function __prepareDataStore($data) 
    {
        return $data;
    }
    public function __prepareQueryListType($query)
    {
        return $query->get();
    }
    public function __successStore()
    {
        return redirect(route('web.pesanan.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function verifikasi($uuid)
    {
        $this->row = $this->model::where('uuid', $uuid)->firstOrFail();
        $update = $this->row->update(['status' => 2]);
        $updatePayment = $this->row->Payment()->update(['approve_date' => date('Y-m-d H:i:s'), 'approve_by' => auth()->user()->id]);

        return redirect(route('web.pesanan.index'));
    }

    public function rejected($uuid)
    {
        $this->row = $this->model::where('uuid', $uuid)->firstOrFail();

        $room = $this->row->Room;
        $room->update(['stock' => (int) $room->stock + 1]);
        $update = $this->row->update(['status' => 0]);
        $update = $this->row->image()->delete();
        $updatePayment = $this->row->Payment()->delete();

        return redirect(route('web.pesanan.index'));
    }

    public function __viewList($data)
    {
        if(auth()->user()->hasRole(RoleConst::STUDENT) AND request('is_student')) {
            return view($this->viewPath . '.pesanan_saya', $data);
        } else {
            return view($this->viewPath . '.list', $data);
        }
    }

    public function __beforeDestroy()
    {
        $room = $this->row->Room;
        $room->update(['stock' => (int) $room->stock + 1]);
    }
}
