<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaman extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_pemakaman";
    protected $fillable = [
        'blok_pemakaman_id',
        'jenazah_id',
        'status_pemakaman',
        'tgl_pemakaman',
        'jam_pemakaman',
        'author_create',
        'author_update',
        'date_created',
        'nama_biaya',
        'nominal_biaya',
        'status_bayar',
    ];

    public function blok()
    {
        return $this->belongsTo(BlokPemakaman::class, 'blok_pemakaman_id', 'id_blok_pemakaman');
    }
    public function jenazah()
    {
        return $this->belongsTo(Jenazah::class, 'jenazah_id', 'id_jenazah');
    }
}
