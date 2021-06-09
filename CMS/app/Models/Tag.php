<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function files(){
        return $this->morphedByMany('App\Models\Files','tagable') ;
    }

    public function videos(){
        return $this->morphedByMany('App\Models\Video','tagable') ;
    }



}
