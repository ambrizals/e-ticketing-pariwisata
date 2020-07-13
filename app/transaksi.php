<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['user','pengunjung','tanggal_booking','jenis_pembayaran','total_bayar','jumlah_bayar','kembalian','status'];

    public function getUser(){
        return $this->belongsTo('App\User','user','id');
    }
    
    public function getPengunjung(){
        return $this->belongsTo('App\Pengunjung','pengunjung','id');
    }

    public function getTicket(){
    	return $this->hasMany('App\eticket','transaksi','id');
    }

    public function getTransaksipaytransfer(){
        return $this->hasOne('App\transaksi_paytransfer','transaksi','id');
    }
}
