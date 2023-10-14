<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_surat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';
    protected $fillable = ['jenis_surat'];
    protected $primaryKey = 'id_jenis_surat';
    public $timestamps = false;

    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_jenis_surat');
    }
}