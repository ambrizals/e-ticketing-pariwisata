<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'karyawan';
    protected $fillable = ['user','nama_karyawan','no_telepon','alamat','foto'];

    public function getUser(){
    	return $this->belongsTo('App\User','user','id');
    }
}
