<?php

namespace App\Http\Controllers\API;

use App\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ImportOutlet;
use App\imports\OutletImport;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Outlet::getAll();
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
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'public', $filename
            );
            ImportOutlet::dispatch($filename);
            return response()->json(['Upload Success']);
        }  
        return response()->json(['Upload Gagal']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $outlets = Excel::toCollection(new OutletImport(), $request->file('file'));
        foreach($outlets[0] as $outlet){
            $findOutlet = Outlet::where('outletid', '=', $outlet[0])->first();
            if($findOutlet){
            Outlet::where('outletid',$outlet[0])->update([
                'rs'          => $outlet[1],
                'logincode'   => $outlet[2],
                'namaoutlet'  => $outlet[3],
                'alamatoutlet'=> $outlet[4],
                'kotakab'     => $outlet[5],
                'kecamatan'   => $outlet[6],
                'kelurahan'   => $outlet[7],
                'nomultichip' => $outlet[8],
                'namapemilik' => $outlet[9],
                'nohppemilik' => $outlet[10],
                'tipeoutlet'  => $outlet[11],
                'latitude'    => $outlet[12],
                'longitude'   => $outlet[13],
                'jadwalkategori' => $outlet[14],
                'hari'        => $outlet[15],
                'sf'          => $outlet[16],
                'ossosk'      => $outlet[17],
                'typeoutlet'  => $outlet[18],
                'tdc'         => $outlet[19]
            ]);
        
    } else {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'public', $filename
            );
            ImportOutlet::dispatch($filename);
            return response()->json(['Upload Success']);
        }  
        return response()->json(['Upload Gagal']);
    }
}
        return ['message' => 'berhasil'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        //
    }
}
