<?php

namespace App\Http\Controllers;

use App\Http\Modules\BaseWebCrud;
use App\Models\Asramas;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\Attendence;
use App\Models\Booking;
use App\Models\RewardHistory;
use App\Models\Room;

class HomeController extends BaseWebCrud
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $asrama = Asramas::count();
        if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF)) {
            $kamar = Room::where('asrama_id', auth()->user()->asrama_id)->count();
            $tamu = Booking::whereHas('room', function($q) {
                return $q->where('asrama_id', auth()->user()->asrama_id);
            })->where('status', 2)->count();
            $booking = Booking::whereHas('room', function($q) {
                return $q->where('asrama_id', auth()->user()->asrama_id);
            })->where('status', 0)->count();
        } else {
            $kamar = Room::count();
            $tamu = Booking::where('status', 2)->count();
            $booking = Booking::where('status', 0)->count();
        }
        return view('dashboard', [
            'asrama' => $asrama,
            'kamar' => $kamar,
            'tamu' => $tamu,
            'booking' => $booking

        ]);
    }

    public function getFiles(Request $request)
    {
        $queryparams = $request->all();
        $path = $queryparams['_path'];
        $path = storage_path('app/public/' . $path);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}