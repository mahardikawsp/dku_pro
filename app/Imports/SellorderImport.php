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
                'tanggal' => $this->transformDate($row[1]),
                '1k'      => $row[2],
                '5k'      => $row[3],  	  	  	  	  	  	  	
                '10k'     => $row[4],
                '20k'     => $row[5],
                '25k'     => $row[6],
                '50k'     => $row[7],
                '100k'    => $row[8],
                'vbulk'   => $row[9],
                'total'   => $row[10],
                'value'   => $row[11]
            ]

        );

        if (! $sellorder->wasRecentlyCreated) {
            $sellorder->update([
                'rs'      => $row[0],
                'tanggal' => $this->transformDate($row[1]),
                '1k'      => $row[2],
                '5k'      => $row[3],  	  	  	  	  	  	  	
                '10k'     => $row[4],
                '20k'     => $row[5],
                '25k'     => $row[6],
                '50k'     => $row[7],
                '100k'    => $row[8],
                'vbulk'   => $row[9],
                'total'   => $row[10],
                'value'   => $row[11]
            ]);
        }
    }
    public function startRow(): int
    {
        return 3;
    }
}
