<?php

namespace App\Http\Controllers\API;

use App\Reason;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reason::listUser();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'id_user'    => 'required',
            'acc'        => 'required'
        ]);
        $cek = User::where('id', '=', $request->id_user)->first();
        return Reason::create([
            'id_user'        => $request['id_user'],
            'id_leader'      => $cek->id_leader,
            'keterangan'     => $request['keterangan'],
            'acc'            => $request['acc'],
            'date_created'   => $request['date_created']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(Reason $reason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function edit(Reason $reason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'acc'    => 'required|string'
        ]);
        $reason = Reason::where('id_reason', '=', $id)->update($request->all());
        return ['message' => 'Update berhasil'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reason = Reason::where('id_reason', '=', $id)->delete();
        return ['message' => 'terhapus'];
    }

    public function search(){
        if($search = \Request::get('q')){
            $users = (new static)->paginateArray(
                DB::select("SELECT b.name as nama_leader,e.name as nama_orang,c.* 
                from leaders a JOIN users b ON a.id_employee = b.id 
                JOIN reasons c on a.id_leader = c.id_leader 
                JOIN users e ON e.id = c.id_user where e.name LIKE '%$search%'")
            );
            return $users;
        } else {
            $users = Reason::listUser();
        }
        return $users;
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
