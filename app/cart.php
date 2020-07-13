<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['user','wahana','qty'];

    public function getUser(){
    	return $this->belongsTo('App\User','user','id');
    }
    public function getWahana(){
    	return $this->belongsTo('App\Wahana', 'wahana' , 'id');
    }
}
