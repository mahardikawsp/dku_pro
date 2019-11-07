<?php

namespace App\Imports;

use App\Disota;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisotaImport implements OnEachRow,WithStartRow,WithChunkReading,ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
    
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $disota = Disota::firstOrCreate(
            ['idisotas' => $row[0]],
            [
                'idisotas'      => $row[0],
                'periode'       => $this->transformDate($row[1]),
                'nama_sf'       => $row[2],
                'kode_product'  => $row[3],  	  	  	  	  	  	  	
                'serial_number' => $row[4],
                'msisdn'        => $row[5],
                'id_digipos'    => $row[6],
                'detail_product'=> $row[7],
                'product'       => $row[8],
                'status_sa_m0'  => $row[9],
                'status_sa_m1'  => $row[10],
                'nama_outlet'   => $row[11],
                'kabkota'	    => $row[12],
                'sub_cluster'	=> $row[13],
                'cluster'       => $row[14],
                'branch'        => $row[15]

            ]

        );

        if (! $disota->wasRecentlyCreated) {
            $disota->update([
                'idisotas'      => $row[0],
                'periode'       => $this->transformDate($row[1]),
                'nama_sf'       => $row[2],
                'kode_product'  => $row[3],  	  	  	  	  	  	  	
                'serial_number' => $row[4],
                'msisdn'        => $row[5],
                'id_digipos'    => $row[6],
                'detail_product'=> $row[7],
                'product'       => $row[8],
                'status_sa_m0'  => $row[9],
                'status_sa_m1'  => $row[10],
                'nama_outlet'   => $row[11],
                'kabkota'	    => $row[12],
                'sub_cluster'	=> $row[13],
                'cluster'       => $row[14],
                'branch'        => $row[15]
            ]);
        }
    }
    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 100000;
    }
}
