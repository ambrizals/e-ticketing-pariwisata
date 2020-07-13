<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pengunjung';
    protected $fillable = ['user','nama_pengunjung','no_telepon'];

    public function getUser(){
        return $this->belongsTo('App\User','user','id');
    }

    public function getTransaksi(){
        return $this->belongsTo('App\transaksi','pengunjung','id');
    }
}
