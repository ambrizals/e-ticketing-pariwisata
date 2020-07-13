<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wahana extends Model
{
    protected $table = 'wahana';
    protected $fillable = ['nama_wahana','deskripsi_singkat','deskripsi_wahana','biaya_wahana','urlslug'];

    public function getGambar(){
        return $this->hasMany('App\Gambar_Wahana','wahana','id');
    }

    public function getTicket(){
    	return $this->hasMany('App\eticket','wahana','id');
    }
}
