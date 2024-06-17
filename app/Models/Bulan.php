<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bulan extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_bulan";
    protected $fillable = [
        'nama_bulan',
        'tgl_jatuh_tempo',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
