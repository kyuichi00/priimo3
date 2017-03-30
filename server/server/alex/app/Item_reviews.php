<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Item_reviews extends Authenticatable
{
    use Notifiable;
    protected $table = 'item_reviews';



}
