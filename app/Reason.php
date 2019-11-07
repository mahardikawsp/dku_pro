<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reason extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_user', 'id_leader', 'keterangan','acc','date_created'
    ];

    public static function GetUser($id){
        return $user = DB::table('reasons')
            ->leftJoin('users', 'reasons.id_user', '=', 'users.id')
            ->select('users.name','reasons.*')
            ->where('reasons.id_leader',$id)
            ->where('reasons.acc','0')
            ->get();

    }
}
