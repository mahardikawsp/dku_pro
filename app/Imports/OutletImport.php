<?php

namespace App\Imports;
use App\Outlet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
// use Maatwebsite\Excel\Concerns\WithMappedCells;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class OutletImport implements ToModel,WithHeadingRow, WithChunkReading,ShouldQueue
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $row) 
    //     {
    //         Outlet::create([
    //             'outletid'    => $row['outletid'],
    //             'rs'          => $row['rs'],
    //             'logincode'   => $row['logincode'],
    //             'namaoutlet'  => $row['namaoutlet'],
    //             'alamatoutlet'=> $row['alamatoutlet'],
    //             'kotakab'     => $row['kotakab'],
    //             'kecamatan'   => $row['kecamatan'],
    //             'kelurahan'   => $row['kelurahan'],
    //             'nomultichip' => $row['nomultichip'],
    //             'namapemilik' => $row['namapemilik'],
    //             'nohppemilik' => $row['nohppemilik'],
    //             'tipeoutlet'  => $row['tipeoutlet'],
    //             'latitude'    => $row['latitude'],
    //             'longitude'   => $row['longitude'],
    //             'jadwalkategori' => $row['jadwalkategori'],
    //             'hari'        => $row['hari'],
    //             'sf'          => $row['sf'],
    //             'ossosk'      => $row['ossosk'],
    //             'typeoutlet'  => $row['typeoutlet'],
    //             'tdc'         => $row['tdc']
    //         ]); 	
    //     }
    // }

    public function model(array $row)
    {
        return new Outlet([
                'outletid'    => $row['outletid'],
                'rs'          => $row['rs'],
                'logincode'   => $row['logincode'],
                'namaoutlet'  => $row['namaoutlet'],
                'alamatoutlet'=> $row['alamatoutlet'],
                'kotakab'     => $row['kotakab'],
                'kecamatan'   => $row['kecamatan'],
                'kelurahan'   => $row['kelurahan'],
                'nomultichip' => $row['nomultichip'],
                'namapemilik' => $row['namapemilik'],
                'nohppemilik' => $row['nohppemilik'],
                'tipeoutlet'  => $row['tipeoutlet'],
                'latitude'    => $row['latitude'],
                'longitude'   => $row['longitude'],
                'jadwalkategori' => $row['jadwalkategori'],
                'hari'        => $row['hari'],
                'sf'          => $row['sf'],
                'ossosk'      => $row['ossosk'],
                'typeoutlet'  => $row['typeoutlet'],
                'tdc'         => $row['tdc']
        ]);
        
    }
    
    public function headingRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
