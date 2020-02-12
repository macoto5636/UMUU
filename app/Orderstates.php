<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstates extends Model
{
    protected $table = 'orderstates';
    public $timestamps = false;

    public function order(){
        return $this->hasMany('App\Order');
    }
}
