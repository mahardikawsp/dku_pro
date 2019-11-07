<?php

namespace App\Imports;
use App\Sellorder;
use App\Sellthrough;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
// use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SellthroughImport implements ToCollection,WithHeadingRow, WithChunkReading,ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Sellthrough::create([
                'rs' => $row['rs'],
                'nama' => $row['nama'],
                'kecamatan' => $row['kecamatan'],
                'kota' => $row['kota'],
                'level' => $row['level'],
                'status' => $row['status'],
                'lcycle' => $row['lcycle'],
                'canvasser' => $row['canvasser'],
                'customer_name' => $row['customer']
            ]);

            Sellorder::create([
                'rs' => $row['rs'],
                'tanggal' => $row['tanggal'],
                '1k' => $row['1k'],
                '5k' => $row['5k'],
                '10k' => $row['10k'],
                '20k' => $row['20k'],
                '25k' => $row['25k'],
                '50k' => $row['50k'],
                '100k' => $row['100k'],
                'vbulk' => $row['vbulk'],
                'total' => $row['total'],
                'value' => $row['value']
            ]);
        }
    }

    // public function model(array $row)
    // {
    //     return new Product([
    //         'rs' => $row['rs'],
    //         'nama' => $row['nama'],
    //         'kecamatan' => $row['kecamatan'],
    //         'kota' => $row['kota'],
    //         'level' => $row['level'],
    //         'status'    => $row['status'],
    //         'lcycle'    => $row['lcycle'],
    //         'canvasser'   => $row['canvasser'],
    //         'customer_name'   => $row['customer']
    //     ]);
        
    // }
    
    public function headingRow(): int
    {
        return 3;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
