<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Pesanan extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;
    
    const DRAFT = 0;
    const PUBLISH = 1;
    const HELD = 2;

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

}
