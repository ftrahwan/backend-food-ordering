<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    protected $table = 'order_detail';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $fillable = [
        'order_id','food_id',
        'quantity','price'
    ];

    
}
