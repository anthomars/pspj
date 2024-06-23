<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = FALSE;
    // protected $table = "tbl_user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'image',
        'is_active',
        'date_created',
        'no_hp',
        'role_id',
        'rw_id',
        'rt_id',
        'author_create',
        'author_update',
        'nik'
    ];

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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id_rw');
    }
    public function rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id_rt');
    }
    public function bulan()
    {
        return $this->hasMany(Bulan::class, 'id', 'user_id');
    }
}
