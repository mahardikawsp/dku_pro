<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class check_out extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'time_out', 'lat', 'long','id_status','id_user'
    ];
}
