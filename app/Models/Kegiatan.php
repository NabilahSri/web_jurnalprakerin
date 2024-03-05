<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function absensi(){
        return $this->belongsTo(Absensi::class, 'id_absensi');
    }

    public function siswa()
{
    return $this->belongsTo(Siswa::class,'id_siswa');
}
}
