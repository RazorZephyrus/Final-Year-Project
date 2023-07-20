<?php

namespace App\Models;

use App\Constants\FileConst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Booking extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;
    
    const BOOKING = 0;
    const PAYMENT = 1;
    const VERIFIED = 2;
    const FAILED = 3;

    protected $table = 'booking';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function image(){
        return $this->morphOne(FileinfoPivot::class, 'fileable')->where('slug', FileConst::PAYMENT_SLUG);
    }

    public function Payment()
    {
        return $this->hasOne(\App\Models\Payment::class, 'booking_id');
    }

    public function User()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function Room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id');
    }

}
