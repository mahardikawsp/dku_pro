<?php

namespace App\Http\Controllers\API;

use App\Canvasser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CanvasserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Canvasser::all();
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
            'id_canvasser'          => 'required|string|max:50',
            'aktif'                => 'required'
        ]);
        return Canvasser::create([
            'id_canvasser'        => $request['id_canvasser'],
            'aktif'              => $request['aktif']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Canvasser  $canvasser
     * @return \Illuminate\Http\Response
     */
    public function show(Canvasser $canvasser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Canvasser  $canvasser
     * @return \Illuminate\Http\Response
     */
    public function edit(Canvasser $canvasser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Canvasser  $canvasser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'id_canvasser'        => 'required|string|max:50',
            'aktif'              => 'required'
        ]);
        $canvaser = Canvasser::where('id_canvas', '=', $id)->update($request->all());
        return ['message' => 'Update berhasil'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Canvasser  $canvasser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $canvaser = Canvasser::where('id_canvas', '=', $id)->delete();
        return ['message' => 'terhapus'];
    }
}
