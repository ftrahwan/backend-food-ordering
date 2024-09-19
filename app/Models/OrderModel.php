<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = 'order_list';
    protected $primarykey = 'id';
    public $timestamps = true;
    public $fillable = [
        'customer_name','table_number',
        'order_date'
    ];
    
    public function orderDetail(){
        return $this->hasMany(DetailModel::class,'order_id');
    }
}
