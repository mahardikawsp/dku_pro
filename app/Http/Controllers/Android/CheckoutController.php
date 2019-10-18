<?php

namespace App\Http\Controllers\android;

use App\Check_out;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
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

        $user = Check_out::where('id_user', '=', $request->id_user)
                          ->where(DB::raw("DATE(check_outs.time_out)"), '=', $sekarang)->first();
        
        if($user){
            $status  = 'failed';
            $message = 'Sudah Check Out';
            $code = 400;
            $data = null;
        } else {
            $status  = 'success';
            $message = 'Checkout Berhasil';
            $code = 200;
            $absent = Check_out::create([
                'time_out'     => $request['time_out'],
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
     * @param  \App\check_out  $check_out
     * @return \Illuminate\Http\Response
     */
    public function show(check_out $check_out)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\check_out  $check_out
     * @return \Illuminate\Http\Response
     */
    public function edit(check_out $check_out)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\check_out  $check_out
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, check_out $check_out)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\check_out  $check_out
     * @return \Illuminate\Http\Response
     */
    public function destroy(check_out $check_out)
    {
        //
    }
}
