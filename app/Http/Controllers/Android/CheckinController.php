<?php

namespace App\Http\Controllers\android;

use App\Check_ins;
use App\Android;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
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

        $user = Check_ins::where('id_user', '=', $request->id_user)
                          ->where(DB::raw("DATE(check_ins.time_in)"), '=', $sekarang)->first();
        
        if($user){
            $status  = 'failed';
            $message = 'Sudah Check In';
            $code = 400;
            $data = null;
        } else {
            $status  = 'success';
            $message = 'Checkin Berhasil';
            $code = 200;
            $absent = Check_ins::create([
                'time_in'     => $request['time_in'],
                'lat'         => $request['lat'],
                'long'        => $request['long'],
                'id_status'   => $request['id_status'],
                'keterangan'  => $request['keterangan'],
                'id_user'     => $request['id_user']
            ]);
            $data = $absent;
        } 
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data], $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\check_ins  $check_ins
     * @return \Illuminate\Http\Response
     */
    public function show(check_ins $check_ins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\check_ins  $check_ins
     * @return \Illuminate\Http\Response
     */
    public function edit(check_ins $check_ins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\check_ins  $check_ins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, check_ins $check_ins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\check_ins  $check_ins
     * @return \Illuminate\Http\Response
     */
    public function destroy(check_ins $check_ins)
    {
        //
    }
}
