<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'category'
    ] ;

    public function user(){
        return $this->belongsTo('App\Models\User') ;
    }




    public function messages(){
        return $this->morphMany('App\Models\Message','messageable');
    }


    public function tags(){
        return $this->morphToMany('App\Models\Tag','tagable');
    }
}
