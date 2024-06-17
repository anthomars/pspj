<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlokPemakaman extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_blok_pemakaman";
    protected $fillable = [
        'nama_blok_pemakaman',
        'kapasitas',
        'nama_pic_blok',
        'hp_pic',
    ];

    public function pemakaman()
    {
        return $this->hasMany(Pemakaman::class, 'id_blok_pemakaman', 'blok_pemakaman_id');
    }
}
