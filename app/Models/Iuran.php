<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_iuran";
    protected $fillable = [
        'nama_iuran',
        'nominal_iuran',
        'metode_bayar',
        'status_bayar',
        'tgl_bayar',
        'author_create',
        'author_update',
        'date_created',
        'biaya_id',
        'user_id',
        'jenazah_id',
    ];

    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'biaya_id', 'id_biaya');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jenazah()
    {
        return $this->belongsTo(Jenazah::class, 'jenazah_id', 'id_jenazah');
    }
}
