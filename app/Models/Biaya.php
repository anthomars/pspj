<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_biaya";
    protected $fillable = [
        'nama_biaya',
        'nominal_biaya',
        'author_create',
        'author_update',
        'date_created',
        'deskripsi'
    ];

    public function iuran()
    {
        return $this->hasMany(Iuran::class, 'id_biaya', 'biaya_id');
    }
}
