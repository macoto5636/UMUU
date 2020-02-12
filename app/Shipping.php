<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;

    public function order(){
        return $this->hasMany('App\Order');
    }
}
