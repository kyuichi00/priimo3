<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'user_ID';

    protected $fillable = [
        'user_nickname','user_zip', 'user_email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
