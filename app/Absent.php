<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absent extends Model
{
    public static function allJoin(){
        return $user = DB::table('users')
            ->Join('check_ins',  'users.id', '=', 'check_ins.id_user')
            ->join('check_outs', 'users.id', '=', 'check_outs.id_user')
            ->join('positions',  'users.id_position', '=', 'positions.id_position')
            ->join('locations',  'users.id_location', '=', 'locations.id_location')
            ->join('statuss as a', 'check_ins.id_status', '=','a.id_status')
            ->join('statuss as b', 'check_outs.id_status', '=','b.id_status')
            ->select('users.name', 'check_ins.time_in', 'check_outs.time_out',
                     'positions.position','locations.location','a.type','b.type')
            ->paginate(5);
    }
}
