<?php

namespace App\Http\Controllers\Android;

use App\Reason;
use App\Check_ins;
use App\Check_out;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        //
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
        $now = \Carbon\Carbon::now();
        $user = $request['id_user'];
        $sekarang = $now->format('Y-m-d');

        $user = Reason::where('id_user', '=', $request->id_user)
                          ->where(DB::raw("DATE(reasons.date_created)"), '=', $sekarang)->first();
        
        if($user){
            $status  = 'failed';
            $message = 'Sudah Ijin';
            $code = 400;
            $data = null;
        } else {
            $status  = 'success';
            $message = 'Ijin Berhasil';
            $code = 200;
            $ijin = Reason::create([
                'id_user'           => $request['id_user'],
                'id_leader'         => $request['id_leader'],
                'keterangan'        => $request['keterangan'],
                'acc'               => $request['acc'],
                'date_created'      => $request['date_created'],
            ]);
            $data = $ijin;
            Check_out::create([
                'time_out'     => $request['date_created'],
                'lat'         =>  $request['lat'],
                'long'        =>  $request['long'],
                'id_status'   => '4',
                'keterangan'  => 'ijin',
                'id_user'     => $request['id_user']
            ]);
            Check_ins::create([
                'time_in'     => $request['date_created'],
                'lat'         =>  $request['lat'],
                'long'        =>  $request['long'],
                'id_status'   => '4',
                'keterangan'  => 'ijin',
                'id_user'     => $request['id_user']
            ]);

        } 
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data], $code);
    }

    /**
     * Display the specified reason from user by leader.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Reason::getUser($id);

        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if($user){
            $status  = 'success';
            $message = 'Data ditemukan';
            // tampilkan data user menggunakan method toArray
            $data = $user->toArray();
            $code = 200;
        }else{
            $message = "Data tidak ditemukan";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data], $code);
    }

    /**
     * Update the specified status by leader.
     *
     * @param  \App\Android  $android
     * @return \Illuminate\Http\Response
     */

    public function approve(Request $request){
        $user = Reason::where('id_reason', '=', $request->id_reason)->first();

        $status = "error";
        $message = "";
        $code = 401;
        $this->validate($request,[
            'id_reason'     => 'required',
            'acc'  => 'required'
        ]);

        if($user){
                Reason::where('id_reason', '=', $request->id_reason)->update($request->all());
                $status  = 'success';
                $message = 'Status absen berhasil diperbarui';
                $code = 200;
        } else{
                $message = "Data tidak ditemukan";
        }
        return response()->json([
            'status' => $status,
            'message' => $message], $code);
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
    public function update(Request $request, Reason $reason)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reason  $reason
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reason $reason)
    {
        //
    }

}
