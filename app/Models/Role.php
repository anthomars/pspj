<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public $timestamps = FALSE;
    protected $table = "tbl_role";
    protected $fillable = [
        'nama_role',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_role', 'role_id');
    }
}
