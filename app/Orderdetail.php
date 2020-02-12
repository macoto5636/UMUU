<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

    public function product(){
        return $this->belongsTo(product::class,'product_id');
    }
}
