<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function files(){

        return $this->hasManyThrough('App\Models\Files','App\Models\User','countId','user_id');
    }
}
