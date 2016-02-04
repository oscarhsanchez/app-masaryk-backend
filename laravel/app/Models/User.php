<?php namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class User extends CartalystUser {
	
    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'facebook_token',
        'remember_token',
        'city',
        'birthday',
        'facebook_id',
    ];

}	
	
?>