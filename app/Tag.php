<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        // il nome della funzione deve essere esplicativo e al plurale
        // relazione many to many (belongsToMany())
        return $this->belongsToMany('App\Post');
    }
}
