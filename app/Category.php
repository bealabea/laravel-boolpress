<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts() {
        // il nome della funzione è al plurale perchè è una relazione di uno a molti con Post
        // questo model ha una relazione di uno a molti (hasMAny()) con il model Post
        // una Categoria può avere più Post
        return $this->hasMany("App\Post");
      }
}
