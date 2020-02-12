<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function orderstates(){
        return $this->belongsTo(Orderstates::class,'state_id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id');
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }

    public function orderdetail(){
        return $this->hasMany('App\Orderdetail');
    }
}
