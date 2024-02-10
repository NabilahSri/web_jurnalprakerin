<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function industri(){
        return $this->belongsTo(Industri::class,'id_industri');
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class,'id_siswa');
    }

    public function guru(){
        return $this->belongsTo(Guru::class,'id_guru');
    }
}
