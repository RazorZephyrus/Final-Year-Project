<?php

namespace App\Models;

use App\Constants\FileConst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class RoomType extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;
    
    const DRAFT = 0;
    const PUBLISH = 1;
    const HELD = 2;

    protected $table = 'room_type';
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
        return $this->morphOne(FileinfoPivot::class, 'fileable')->where('slug', FileConst::IMAGE_ROOM_TYPE_SLUG);
    }

    public function images(){
        return $this->morphMany(FileinfoPivot::class, 'fileable')->where('slug', FileConst::IMAGE_ROOM_TYPE_SLUG);
    }

    public function Asrama() 
    {
        return $this->belongsTo(\App\Models\Asramas::class, 'asrama_id');
    }

    public function Rooms()
    {
        return $this->hasMany(\App\Models\Room::class, 'room_type_id');
    }

}
