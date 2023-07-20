<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Students extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    protected $table = 'students';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
