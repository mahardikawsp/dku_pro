<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Absent extends Model
{
    // public static function allJoin(){
    //     return $user = DB::table('users')
    //         ->leftJoin('check_ins',  'users.id', '=', 'check_ins.id_user')
    //         ->leftJoin('check_outs', 'users.id', '=', 'check_outs.id_user')
    //         ->leftJoin('positions',  'users.id_position', '=', 'positions.id_position')
    //         ->leftJoin('locations',  'users.id_location', '=', 'locations.id_location')
    //         ->leftJoin('statuss as a', 'check_ins.id_status', '=','a.id_status')
    //         ->leftJoin('statuss as b', 'check_outs.id_status', '=','b.id_status')
    //         ->leftJoin('check_outs as c','DATE(check_ins.time_in)','=','DATE(c.time_out)')
    //         ->select('users.name', 'check_ins.time_in', 'check_outs.time_out',
    //                  'positions.position','locations.location','a.type','b.type','a.id_status as status_masuk',
    //                  'b.id_status as status_pulang')
    //         ->paginate(5);
    // }

    public static function allJoin(){
        $query = (new static)->paginateArray(
            DB::select("SELECT a.name,b.time_in,c.time_out,d.type as absen_masuk,e.type as absen_keluar, f.location
            from users a join check_ins b on a.id = b.id_user 
            left join check_outs c on date(b.time_in) = date(c.time_out) 
            left join statuss d on b.id_status = d.id_status 
            left join locations f on a.id_location = f.id_location
            left join statuss e on c.id_status = e.id_status WHERE DATE(b.time_in) = DATE(c.time_out) GROUP BY b.time_in")
        );
        return $query;
    }

    public function paginateArray($data, $perPage = 15)
    {
        $page = Paginator::resolveCurrentPage();
        $total = count($data);
        $results = array_slice($data, ($page - 1) * $perPage, $perPage);

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }
}
