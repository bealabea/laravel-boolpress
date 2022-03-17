<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id'];

    
    // public $date = 'd-m-Y H:i';

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

    public function printUpdateAt(){
        if($this->updated_at->diffInHours(Carbon::now()) <= 12){
                return $this->updated_at->diffForHumans(Carbon::now());
        }else{ 
               return $this->dateFormat($this->updated_at);
        }
    }

    public function printCreateAt(){
        return $this->dateFormat($this->created_at);
    }

    protected function dateFormat($myDate){
        return $myDate->format(config('dateformat.dateFormat'));
    }
}
