<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public static function listUser(){
        $query = (new static)->paginateArray(
            DB::select("SELECT b.name as nama_leader,e.name as nama_orang,c.* 
        from leaders a JOIN users b ON a.id_employee = b.id 
        JOIN reasons c on a.id_leader = c.id_leader 
        JOIN users e ON e.id = c.id_user ORDER BY c.date_created DESC")
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
