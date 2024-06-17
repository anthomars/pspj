<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rt extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_rt";
    protected $fillable = [
        'nama_rt',
        'no_rt',
        'alamat_rt',
        'rw_id'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_rt', 'rt_id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_rw', 'rw_id');
    }
}
