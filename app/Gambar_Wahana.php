<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar_Wahana extends Model
{
    protected $table = 'gambar_wahana';
    protected $fillable = ['wahana','wahanagambar_filename','wahanagambar_type'];

    public function wahana(){
        return $this->belongsTo('App\wahana','wahana','id');
    }
}
