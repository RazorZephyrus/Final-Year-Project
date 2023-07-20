<?php

namespace App\Http\Controllers;

use App\Http\Modules\BaseWebCrud;
use App\Models\Asramas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Attendence;
use App\Models\Booking;
use App\Models\RewardHistory;
use App\Models\Room;

class ListRoomController extends BaseWebCrud
{
    public $viewPath = 'front.rooms';
    public function listRoom(Request $request)
    {
        $asrama = Asramas::get();
        $room = Room::limit(4)->inRandomOrder()->get();
        return view($this->viewPath.'.list-room', [
            'asrama' => $asrama,
            'room' => $room
        ]);
    }

    public function roomDetail($uuid, Request $request)
    {
       $room = Room::where('uuid', $uuid)->firstOrFail();
        return view('front.rooms.detail-room', [
            'row' => $room,
        ]);
    }

    public function RoomBooking(Request $request)
    {
       $input = $request->all();
       $input['room_id'] = Room::getId($input['room_id']);
       $input['user_id'] = auth()->user()->id;

       $check = Booking::where('room_id', $input['room_id'])->where('user_id', $input['user_id'])->first();
       unset($input['_token']);
       if($check == null) {
           Booking::create($input);
       } else {
            $check->update($input);
       }

       return redirect(url()->previous());
    }
}