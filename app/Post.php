<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id'];

    public function user(){
        // il nome della funzione deve essere esplicativo e al singolare
        // tabella secondaria che APPARTIENE (belongsTo()) al model User (relazione di dipendenza)
        // un post appartiene ad un solo Utente
        return $this->belongsTo('App\User');
    }
    public function category(){
        // il nome della funzione deve essere esplicativo e al singolare
        // tabella secondaria che APPARTIENE (belongsTo()) al model Category (relazione di dipendenza)
        // un post appartiene ad una sola Categoria
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        // il nome della funzione deve essere esplicativo e al plurale
        // relazione many to many (belongsToMany())
        return $this->belongsToMany('App\Tag');
    }
}
