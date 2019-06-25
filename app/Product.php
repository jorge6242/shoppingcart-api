<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'name', 
        'price', 
        'description',  
        'photo', 
        'categories_id', 
        'user_id',
    ];
}
