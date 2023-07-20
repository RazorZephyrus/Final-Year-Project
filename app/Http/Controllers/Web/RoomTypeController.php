<?php

namespace App\Http\Controllers\Web;

use App\Http\Modules\BaseWebCrud;
use App\Http\Requests\Web\RoomType\RoomTypeRequest;
use App\Models\RoomType;
use App\Services\UploadService;
use App\Constants\FileConst;
use Illuminate\Support\Str;

class RoomTypeController extends BaseWebCrud
{
    public $model = RoomType::class;
    public $viewPath = 'pages.room-type';

    public $storeValidator = RoomTypeRequest::class;
    public $updateValidator = RoomTypeRequest::class;

    public $uploaded = [];

    public function __prepareQueryList($query)
    {
        if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF)) {
            $query = $query->where('asrama_id', auth()->user()->asrama_id);
        }
        return $query;
    }

    public function __prepareDataStore($data) 
    {
        $data['asrama_id'] = auth()->user()->asrama_id;
        return $data;
    }
    public function __successStore()
    {
        return redirect(route('web.room-type.index'));
    }

    public function __prepareDataUpdate($data)
    {
        return $this->__prepareDataStore($data);
    }

    public function __successUpdate()
    {
        return $this->__successStore();
    }

    public function __beforeStore()
    {
        $uploadData = [];
        if($this->requestData->hasFile('images')){

            foreach ($this->requestData->file('images') as $key => $value) {
                $upload = new UploadService(
                    $value,
                    FileConst::IMAGE_ROOM_TYPE_PATH,
                    (string) Str::uuid()
                );
    
                $upload->uploadResize(300);
                $uploadData[] = $upload;
           }
        }

        $this->uploaded = $uploadData;
    }

    public function __beforeUpdate()
    {
        $this->__beforeStore();
    }

    public function __afterUpdate()
    {
        if (!empty($this->uploaded)) {
            foreach ($this->uploaded as $key => $value) {
                $value->deleteFile($this->row->image());
            }
        }

        $this->__afterStore();
    }

    public function __afterStore()
    {

        if (!empty($this->uploaded)) {
            foreach ($this->uploaded as $key => $value) {
                $value->saveFile($this->row->image(), ['slug' =>  FileConst::IMAGE_ROOM_TYPE_SLUG]);
            }
        }

        $rooms = $this->row->Rooms;
        foreach ($rooms as $value) {
            $row = $value;
            if($value->Bookings()->where('status', '!=', \App\Models\Booking::FAILED)->count() == 0) {
                $row->update(['stock', $this->requestData->input('total_bed')]);
            }
        }
    }
}
