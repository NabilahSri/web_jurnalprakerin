<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenKeluar extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'token_keluars';

    public function industri(){
        return $this->belongsTo(Industri::class,'id_industri');
    }
}
