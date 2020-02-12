<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Want extends Model
{
    //
    protected $table ='wants';
    public $timestamps = false;
    //belongsTo結合
    public function category()
    {
        return $this->belongsTo('App\product');
        return $this->belongsTo('App\User');
    }

}