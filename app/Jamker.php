<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamker extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'start', 'end'
    ];
}
