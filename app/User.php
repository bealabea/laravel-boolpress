<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function infoUser(){
        // il nome della funzione è al singolare perchè è una relazione singolare con InfoUser
        // questo model ha una relazione di uno (hasOne()) con il model InfoUser
        return $this->hasOne('App\InfoUser');
    }

    public function posts(){
        // il nome della funzione è al plurale perchè è una relazione di uno a molti con Post
        // questo model ha una relazione di uno a molti (hasMAny()) con il model Post
        // un utente può avere più Posts
        return $this->hasMany('App\Post');
    }

}
