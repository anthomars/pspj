<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_setting";
    protected $fillable = [
        'nama_apps',
        'logo_apps',
        'nama_panjang_apps',
        'alamat',
        'author_create',
        'author_update',
        'date_created',
        'token_whatsapp',
        'telegram_bot_token',
        'telegram_id',
        'no_tlp',
        'email',
        'teks_rimend'
    ];
}
