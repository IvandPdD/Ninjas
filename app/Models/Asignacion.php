<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    public function ninja(){
    	return $this->belongsTo(Ninja::class);
    }

    public function mision(){
    	return $this->belongsTo(Mision::class);
    }
}
