<?php

namespace App\Models;

use App\Constants\FileConst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Room extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;
    
    const DRAFT = 0;
    const PUBLISH = 1;
    const HELD = 2;

    protected $table = 'room';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    protected $with = [
        'RoomType',
        'Asrama',
        'RoomFasilitas',
        'image',
        'images',
        'Booking'
    ];

    public function image(){
        return $this->morphOne(FileinfoPivot::class, 'fileable')->where('slug', FileConst::IMAGE_ROOM_SLUG);
    }

    public function images(){
        return $this->morphMany(FileinfoPivot::class, 'fileable')->where('slug', FileConst::IMAGE_ROOM_SLUG);
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function RoomType() 
    {
        return $this->belongsTo(\App\Models\RoomType::class, 'room_type_id');
    }

    public function Asrama() 
    {
        return $this->belongsTo(\App\Models\Asramas::class, 'asrama_id');
    }

    public function RoomFasilitas() 
    {
        return $this->hasMany(\App\Models\RoomFasilitas::class, 'room_id');
    }

    public function Booking()
    {
        return $this->hasOne(\App\Models\Booking::class, 'room_id');
    }

    public function Bookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'room_id');
    }

}
