<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function monitoring(){
        return $this->hasMany(Monitoring::class,'id_industri');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function token(){
        return $this->hasMany(Token::class, 'id_industri');
    }

    public function tokenKeluar(){
        return $this->hasMany(TokenKeluar::class, 'id_industri');
    }
}
