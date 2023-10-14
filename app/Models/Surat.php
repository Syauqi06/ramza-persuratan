<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $fillable = ['id_user', 'id_jenis_surat', 'tanggal_surat', 'ringkasan', 'file'];
    protected $primaryKey = 'id_surat';
    public $timestamps = false;

    public function jenis()
    {
        return $this->belongsTo(Jenis_surat::class);
    }

    public function user()
    {
        return $this->belongsTo(Tbl_user::class);
    }

    public function getJenisSuratAttribute()
    {
        return Jenis_surat::find($this->attributes['id_jenis_surat'])->jenis_surat;
    }

    public function getUsernameAttribute()
    {
        return Tbl_user::find($this->attributes['id_user'])->username;
    }
    
};
