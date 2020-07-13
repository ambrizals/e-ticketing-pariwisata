<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengaturan extends Model
{
    protected $table = 'pengaturan';
    protected $fillable = ['name', 'value'];
    public $timestamps = false;
}
