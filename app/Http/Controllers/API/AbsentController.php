<?php

namespace App\Http\Controllers\API;

use App\Absent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Absent::allJoin();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Search By Filter
     *
     * @return \Illuminate\Http\Response
     */

    public static function uabsent(){
        if($search = \Request::get('q')){
        $query = (new static)->paginateArray(
            DB::select("SELECT a.name,b.time_in,c.time_out,d.type as absen_masuk,e.type as absen_keluar 
            from users a join check_ins b on a.id = b.id_user 
            left join check_outs c on date(b.time_in) = date(c.time_out) 
            left join statuss d on b.id_status = d.id_status 
            left join statuss e on c.id_status = e.id_status WHERE a.id LIKE '%$search%' GROUP BY b.time_in")
        );
        return $query;
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit(absent $absent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, absent $absent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(absent $absent)
    {
        //
    }
}
