<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'tbl_pembayaran';

    protected $fillable = [
        'iuran_id',
        'tgl_bayar',
        'metode_bayar',
        'bukti_bayar',
    ];

    public function iuran() : BelongsTo
    {
        return $this->belongsTo(Iuran::class, 'iuran_id', 'id_iuran');
    }
}
