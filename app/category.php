<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'string'
    );

}
