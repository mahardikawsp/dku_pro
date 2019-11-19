<?php

namespace App\Imports;

use App\Sellorder;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class SellorderImport implements OnEachRow,WithStartRow
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
        $sellorder = Sellorder::firstOrCreate(
            ['rs' => $row[0]],
            [
                'rs'      => $row[0],
                'level'   => $row[1],
                'status'  => $row[2],
                'lcycle'  => $row[3],
                'id_canvasser' => $row[4],
                'tanggal' => $this->transformDate($row[5]),
                '1k'      => $row[6],
                '5k'      => $row[7],  	  	  	  	  	  	  	
                '10k'     => $row[8],
                '20k'     => $row[9],
                '25k'     => $row[10],
                '50k'     => $row[11],
                '100k'    => $row[12],
                'vbulk'   => $row[13],
                'total'   => $row[14],
                'value'   => $row[15]
            ]

        );

        if (! $sellorder->wasRecentlyCreated) {
            $sellorder->update([
                'rs'      => $row[0],
                'level'   => $row[1],
                'status'  => $row[2],
                'lcycle'  => $row[3],
                'id_canvasser' => $row[4],
                'tanggal' => $this->transformDate($row[5]),
                '1k'      => $row[6],
                '5k'      => $row[7],  	  	  	  	  	  	  	
                '10k'     => $row[8],
                '20k'     => $row[9],
                '25k'     => $row[10],
                '50k'     => $row[11],
                '100k'    => $row[12],
                'vbulk'   => $row[13],
                'total'   => $row[14],
                'value'   => $row[15]
            ]);
        }
    }
    public function startRow(): int
    {
        return 3;
    }
}
