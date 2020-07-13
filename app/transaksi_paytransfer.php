<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi_paytransfer extends Model
{
    protected $table = 'transaksi_paytransfer';
    protected $fillable = ['transaksi','bank','jumlah_transfer','tanggal_transfer','status'];

    public function getTransaksi(){
        return $this->belongsTo('App\transaksi', 'transaksi', 'id');
    }

    public function getBank(){
        return $this->belongsTo('App\bank','bank','id');
    }
}
