<?php
namespace App\Http\Controllers\API;
set_time_limit(0);
ini_set('memory_limit', '2048M');
use App\Disota;
use App\Jobs\ImportDisota;
use App\imports\DisotaImport;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisotaController extends Controller
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
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'public', $filename
            );
            ImportDisota::dispatch($filename);
            return response()->json(['Upload Success']);
        }  
        return response()->json(['Upload Gagal']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disota  $disota
     * @return \Illuminate\Http\Response
     */
    public function show(Disota $disota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disota  $disota
     * @return \Illuminate\Http\Response
     */
    public function edit(Disota $disota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disota  $disota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disota $disota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disota  $disota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disota $disota)
    {
        //
    }
}
