<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    public function user(){
        // il nome della funzione deve essere esplicativo
        // tabella secondaria che APPARTIENE (belongsTo()) al model User (relazione di dipendenza)
        return $this->belongsTo('App\User');
    }
}
