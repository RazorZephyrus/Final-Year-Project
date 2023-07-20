<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasBaseOwner;
use App\Traits\HasBaseTable;
class FileinfoPivot extends Model
{
    use HasBaseOwner, HasBaseTable;

    protected $table = 'file_infos';

    protected $guarded =['id', 'uuid'];
    
    public $timestamps = true;

    protected $hidden = [
        'fileable_type',
        'fileable_id',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
