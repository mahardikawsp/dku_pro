<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
Use App\Position;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Position::all();
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
            'position'    => 'required|string|max:50',
            'latitude'    => 'required|string',
            'longitude'   => 'required|string',
        ]);
        return Position::create([
            'position'        => $request['position'],
            'latitude'        => $request['latitude'],
            'longitude'       => $request['longitude'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'position'    => 'required|string|max:50',
            'latitude'    => 'required|string',
            'longitude'   => 'required|string',
        ]);
        $jabatan = Position::where('id_position', '=', $id)->update($request->all());
        return ['message' => 'Update berhasil'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jabatan = Position::where('id_position', '=', $id)->delete();
        return ['message' => 'terhapus'];
    }
}
