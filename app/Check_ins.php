<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check_ins extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'time_in', 'lat', 'long','id_status','id_user'
    ];
}
