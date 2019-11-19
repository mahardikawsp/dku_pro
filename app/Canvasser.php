<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canvasser extends Model
{
    protected $fillable = [
        'id_canvasser','aktif'
    ];

    protected $primaryKey = 'id_canvas';

    public $timestamps = false;


}
