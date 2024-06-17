<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rw extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_rw";
    protected $fillable = [
        'nama_rw',
        'no_rw',
        'alamat_rw',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_rw', 'rw_id');
    }

    public function rt()
    {
        return $this->hasMany(Rt::class, 'id_rw', 'rw_id');
    }
}
