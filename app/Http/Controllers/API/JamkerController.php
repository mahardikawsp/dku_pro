<?php

namespace App\Http\Controllers\API;

use App\Jamker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JamkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Jamker::all();
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
            'start'       => 'required|string|max:191',
            'end'         => 'required|string|max:191'
        ]);
        return Jamker::create([
            'start'      => $request['start'],
            'end'        => $request['end']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jamker  $jamker
     * @return \Illuminate\Http\Response
     */
    public function show(Jamker $jamker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jamker  $jamker
     * @return \Illuminate\Http\Response
     */
    public function edit(Jamker $jamker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jamker  $jamker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'start'       => 'required|string|max:191',
            'end'         => 'required|string|max:191'
        ]);
        $jamker = Jamker::where('id_jamker', '=', $id)->update($request->all());
        return ['message' => 'Update berhasil'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jamker  $jamker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jamker = Jamker::where('id_jamker', '=', $id)->delete();
        return ['message' => 'terhapus'];
    }
}
