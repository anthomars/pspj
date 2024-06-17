<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenazah extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_jenazah";
    protected $fillable = [
        'nama_jenazah',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'tgl_wafat',
        'tempat_wafat',
        'alamat',
        'keluarga',
        'author_create',
        'author_update',
        'date_created',
        'iuran_id',
        'user_id',
    ];

    public function iuran()
    {
        return $this->hasMany(Iuran::class, 'id_jenazah', 'jenazah_id');
    }
    public function pemakaman()
    {
        return $this->hasOne(Pemakaman::class, 'id_jenazah', 'jenazah_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
