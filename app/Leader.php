<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leader extends Model
{   
    public $timestamps = false;

    protected $fillable = [
        'type', 'id_employee'
    ];

    public static function allJoin(){
        return $user = DB::table('leaders')
            ->leftJoin('users', 'leaders.id_employee', '=', 'users.id')
            ->select('users.name', 'leaders.id_leader','leaders.type','leaders.id_employee')
            ->get();
    }
}
