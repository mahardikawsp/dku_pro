<?php

namespace App\Http\Controllers\API;

use App\Absent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
