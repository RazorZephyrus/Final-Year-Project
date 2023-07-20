<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasBaseTable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\HasBaseOwner;
use App\Constants\FileConst;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasBaseTable, HasRoles, HasBaseOwner;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'is_enabled',
        'code_otp',
        'asrama_id',
        'nik',
        'gender',
        'fakultas',
    ];

    protected $guarded =['id', 'uuid'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'permissions',
        'roles',
    ];

    public function avatar(){
        return $this->morphOne(FileinfoPivot::class, 'fileable')->where('slug', FileConst::USER_AVATAR_SLUG);
    }

    public function asrama(){
        return $this->belongsTo(\App\Models\Asramas::class, 'asrama_id');
    }

}
