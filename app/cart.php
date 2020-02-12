<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    protected $table ='shoppings';
    public $timestamps = false;
    //belongsTo結合
    public function category()
    {
        return $this->belongsTo('App\product');
        return $this->belongsTo('App\User');
    }

}