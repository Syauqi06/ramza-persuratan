<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tbl_user extends Authenticatable
{
    use HasFactory;
    protected $table = 'tbl_user';
    protected $fillable = ['username', 'password', 'role'];
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    protected $casts = [
        'password' => 'hashed',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class, 'id_user');
    }
}
