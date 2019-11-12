<?php

namespace App\Http\Controllers\API;

use App\Absent;
use App\User;
use App\Check_ins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Excel;
use App\Exports\AbsentExport;

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
     * Search By Filter
     *
     * @return \Illuminate\Http\Response
     */

    public static function uabsent(){
        if($search = \Request::get('q')){
        $query = (new static)->paginateArray(
            DB::select("SELECT a.name,b.time_in,c.time_out,d.type as absen_masuk,e.type as absen_keluar, f.location 
            from users a join check_ins b on a.id = b.id_user 
            left join check_outs c on date(b.time_in) = date(c.time_out) 
            left join statuss d on b.id_status = d.id_status 
            left join locations f on a.id_location = f.id_location
            left join statuss e on c.id_status = e.id_status WHERE a.id LIKE '%$search%' GROUP BY b.time_in")
        );
        } else {
            $query = (new static)->paginateArray(
                DB::select("SELECT a.name,b.time_in,c.time_out,d.type as absen_masuk,e.type as absen_keluar, f.location 
                from users a join check_ins b on a.id = b.id_user 
                left join check_outs c on date(b.time_in) = date(c.time_out) 
                left join statuss d on b.id_status = d.id_status 
                left join locations f on a.id_location = f.id_location
                left join statuss e on c.id_status = e.id_status GROUP BY b.time_in")
            );
        }
        return $query;
    }

    public function paginateArray($data, $perPage = 10)
    {
        $page = Paginator::resolveCurrentPage();
        $total = count($data);
        $results = array_slice($data, ($page - 1) * $perPage, $perPage);

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
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

    public function filter()
    {
        $filter = request()->year . '-' . request()->month; //GET DATA BULAN & TAHUN YANG DIKIRIMKAN SEBAGAI PARAMETER
      
        $parse = Carbon::parse($filter); //UBAH FORMATNYA MENJADI FORMAT CARBON
        //BUAT RANGE TANGGAL PADA BULAN TERKAIT
        $array_date = range($parse->startOfMonth()->format('d'), $parse->endOfMonth()->format('d'));
      
        //GET DATA TRANSAKSI BERDASARKAN BULAN & TANGGAL YANG DIMINTA.
        //GROUP / KELOMPOKKAN BERDASARKAN TANGGALNYA
        //SUM DATA AMOUNT DAN SIMPAN KE NAMA BARU YAKNI TOTAL

        // $absen = Check_ins::select(DB::raw('date(time_in) as date,sum(id_user) as total'))
        //     ->where('time_in', 'LIKE', '%' . $filter . '%')
        //     ->groupBy(DB::raw('date(time_in)'))->get();

        // $absen  = DB::select("SELECT a.name,b.time_in as date,c.time_out,d.type as absen_masuk,e.type as absen_keluar, f.location 
        // from users a join check_ins b on a.id = b.id_user 
        // left join check_outs c on date(b.time_in) = date(c.time_out) 
        // left join statuss d on b.id_status = d.id_status 
        // left join locations f on a.id_location = f.id_location
        // left join statuss e on c.id_status = e.id_status WHERE b.time_in LIKE '%$filter%' GROUP BY b.time_in");

        $absen = DB::table('users')
                 ->leftjoin('check_ins','users.id','=','check_ins.id_user')
                 ->select(DB::raw('users.name as nama,check_ins.time_in as cekin,date(check_ins.time_in) as date,sum(check_ins.id_user) as total,users.id'))
                 ->where('check_ins.time_in', 'LIKE',  '%' . $filter . '%')
                 ->groupBy(DB::raw('date(check_ins.time_in)'))->get();
        
        $data = [];
        //LOOPING RANGE TANGGAL BULAN SAAT INI
        foreach ($array_date as $row) {
            //KITA CEK TANGGALNYA, JIKA HANYA 1 ANGKA (1-9) MAKA TAMBAHKAN 0 DIDEPANNYA
            $f_date = strlen($row) == 1 ? 0 . $row:$row;
            //BUAT FORMAT TANGGAL YYYY-MM-DD
            $date = $filter . '-' . $f_date; 
            //CARI DATA BERDASARKAN $DATE PADA COLLECTION HASIL QUERY
            $total = $absen->firstWhere('date', $date);
            // $name = $absen->firstWhere('name',$absen['name']);
            
            
 
            //SIMPAN DATANY A KE DALAM VARIABLE $DATA
            $data[] = [
                'date' =>$date,
                'cekin' => $total ? $total->cekin:0,
                'name' => $total ? $total->nama:0,
                'id' => $total ? $total->id:0
            ];
        }
        return $data;
    }

    public function exportData(Request $request)
    {
        $absen = $this->filter(); //KARENA QUERYNYA SAMA, MAKA KITA AMBIL DATA DARI METHOD CHART() SAJA SEHINGGA KITA TIDAK PERLU MEMBUAT CODE YANG SAMA
        //REQUEST UNTUK MENDOWNLOAD FILE EXCEL
        //MENGGUNAKAN TRANSACTIONEXPORT() DAN MENGIRIMKAN 3 BUAH DATA
        //DATA TRANSAKSI, DATA BULAN DAN TAHUN YANG DIMINTA
        //DAN NAMA FILE YANG DIHASILKAN ADALAH transaction.xlsx
        return Excel::download(new AbsentExport($absen, request()->month, request()->year), 'transaction.xlsx');
    }
}
