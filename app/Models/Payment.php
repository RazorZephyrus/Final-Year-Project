<?php

namespace App\Models;

use App\Constants\FileConst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Payment extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;
    
    const UNPAID = 0;
    const PAID = 1;

    protected $table = 'payment';
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

    public function Booking() {
        return $this->belongsTo(\App\Models\Booking::class, 'booking_id');
    }

    public function ApproveBy()
    {
        return $this->belongsTo(\App\Models\User::class, 'approve_by');
    }

}
