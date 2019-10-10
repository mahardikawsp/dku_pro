<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Android extends Model
{
    protected $table = 'users';

    public static function GetUser($id){
        return $user = DB::table('users')
            ->leftJoin('positions', 'users.id_position', '=', 'positions.id_position')
            ->leftJoin('locations','users.id_location', '=', 'locations.id_location')
            ->leftJoin('leaders','users.id_leader', '=', 'leaders.id_leader')
            ->select('users.id','users.name','users.no_hp','users.photo',
                    'users.id_location','users.id_position','users.id_leader',
                    'users.id_location',
                    'positions.position','locations.location','locations.latitude','locations.longitude')
            ->where('users.id',$id)
            ->get();
    }
}
