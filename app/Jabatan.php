<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'name', 'email', 'password','no_hp','id_location','id_leader','id_position'
    ];
}
