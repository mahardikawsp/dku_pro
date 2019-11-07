<?php

namespace App\Http\Controllers\API;

use App\Sellorder;
use App\Jobs\ImportSellorder;
use App\imports\SellorderImport;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellorderController extends Controller
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
            ImportSellorder::dispatch($filename);
            return response()->json(['Upload Success']);
        }  
        return response()->json(['Upload Gagal']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sellorder  $sellorder
     * @return \Illuminate\Http\Response
     */
    public function show(Sellorder $sellorder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sellorder  $sellorder
     * @return \Illuminate\Http\Response
     */
    public function edit(Sellorder $sellorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sellorder  $sellorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sellorder $sellorder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sellorder  $sellorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sellorder $sellorder)
    {
        //
    }
}
