<?php

namespace App\Http\Controllers\android;

use App\Check_out;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return Check_out::create([
            'time_out'     => $request['time_out'],
            'lat'         => $request['lat'],
            'long'        => $request['long'],
            'id_status'   => $request['id_status'],
            'keterangan'  => $request['keterangan'],
            'id_user'     => $request['id_user']
        ]);
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
