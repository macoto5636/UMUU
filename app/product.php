<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';

    protected $guarded = array('id');
    protected $fillable = ['image'];


    //cart
    public function cart(){
        return $this->hasMany('cart');
    }

    //cart
    public function orderdetail(){
        return $this->hasMany('Orderdetail');
    }
}
