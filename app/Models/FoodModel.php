<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodModel extends Model
{
    protected $table = 'food';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $fillable = [
        'name','spicy_level',
        'price','image'
    ];
}
