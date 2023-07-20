<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use App\Traits\HasBaseOwner;

class Settings extends Model
{
    use HasFactory, SoftDeletes, HasBaseTable, HasBaseOwner;

    const POINT_ABSEN_SLUG = 'ABSEN-POINT-SLUG';
    const POINT_FEE_SLUG = 'FEE-POINT-SLUG';

    protected $table = 'settings';
    public $timestamps = true;
    protected $guarded =['id', 'uuid'];

}
