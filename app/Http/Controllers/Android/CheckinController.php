<?php

namespace App\Http\Controllers\android;

use App\Check_ins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return Check_ins::create([
            'time_in'     => $request['time_in'],
            'lat'         => $request['lat'],
            'long'        => $request['long'],
            'id_status'   => $request['id_status'],
            'id_user'     => $request['id_user']
        ]);
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
