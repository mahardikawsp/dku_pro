<?php

namespace App\Http\Controllers\API;

use App\Sellthrough;
use Illuminate\Http\Request;
use App\Jobs\ImportJob;
use App\Http\Controllers\Controller;

class SellthroughController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
            ImportJob::dispatch($filename);
            return response()->json(['Upload Success']);
        }  
        return response()->json(['Upload Gagal']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sellthrough  $sellthrough
     * @return \Illuminate\Http\Response
     */
    public function show(Sellthrough $sellthrough)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sellthrough  $sellthrough
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sellthrough  $sellthrough
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sellthrough $sellthrough)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sellthrough  $sellthrough
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sellthrough $sellthrough)
    {
        //
    }
}
