<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eticket extends Model
{
    protected $table = 'eticket';
    protected $fillable = ['transaksi','wahana','qty','harga','total'];

    public function getTransaksi(){
        return $this->belongsTo('App\transaksi', 'transaksi', 'id');
    }

    public function getWahana(){
        return $this->belongsTo('App\wahana','wahana','id');
    }
}
