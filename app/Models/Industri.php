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
}
