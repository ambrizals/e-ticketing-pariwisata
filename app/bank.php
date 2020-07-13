<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    protected $table = 'bank';
    protected $fillable = ['nama_bank','nama_rekening','nomor_rekening','status'];

    public function getPaytransfer(){
        return $this->hasMany('App\transaksi_paytransfer','bank','id');
    }
}
