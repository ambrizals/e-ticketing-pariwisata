<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getKaryawan(){
        return $this->hasOne('App\Karyawan','user','id');
    }

    public function getPengunjung(){
        return $this->hasOne('App\Pengunjung','user','id');
    }

    public function getTransaksi(){
        return $this->hasMany('App\transaksi','user','id');
    }
}
