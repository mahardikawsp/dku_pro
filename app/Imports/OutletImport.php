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
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class OutletImport implements OnEachRow,WithStartRow
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

    // public function model(array $row)
    // {
    //     $getOutlet = Outlet::where('outletid', '=', $row['outletid'])->first();
    //     if($getOutlet){
    //         $getOutlet->update([
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
    //         return ['message' => 'Update Berhasil'];
    //     }
    //     return new Outlet([
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
    //     ]);
        
    // }
    
    // public function headingRow(): int
    // {
    //     return 2;
    // }

    // public function chunkSize(): int
    // {
    //     return 1000;
    // }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $outlets = Outlet::firstOrCreate(
            ['outletid' => $row[0]],
            [
                'outletid'    => $row[0],
                'rs'          => $row[1],
                'logincode'   => $row[2],
                'namaoutlet'  => $row[3],
                'alamatoutlet'=> $row[4],
                'kotakab'     => $row[5],
                'kecamatan'   => $row[6],
                'kelurahan'   => $row[7],
                'nomultichip' => $row[8],
                'namapemilik' => $row[9],
                'nohppemilik' => $row[10],
                'tipeoutlet'  => $row[11],
                'latitude'    => $row[12],
                'longitude'   => $row[13],
                'jadwalkategori' => $row[14],
                'hari'        => $row[15],
                'sf'          => $row[16],
                'ossosk'      => $row[17],
                'typeoutlet'  => $row[18],
                'tdc'         => $row[19]
            ]

        );

        if (! $outlets->wasRecentlyCreated) {
            $outlets->update([
                'rs'          => $row[1],
                'logincode'   => $row[2],
                'namaoutlet'  => $row[3],
                'alamatoutlet'=> $row[4],
                'kotakab'     => $row[5],
                'kecamatan'   => $row[6],
                'kelurahan'   => $row[7],
                'nomultichip' => $row[8],
                'namapemilik' => $row[9],
                'nohppemilik' => $row[10],
                'tipeoutlet'  => $row[11],
                'latitude'    => $row[12],
                'longitude'   => $row[13],
                'jadwalkategori' => $row[14],
                'hari'        => $row[15],
                'sf'          => $row[16],
                'ossosk'      => $row[17],
                'typeoutlet'  => $row[18],
                'tdc'         => $row[19]
            ]);
        }
    }
    public function startRow(): int
    {
        return 3;
    }
}
