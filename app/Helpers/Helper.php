<?php
// namespace App\Helpers;

use Carbon\Carbon;

function getDay($tgl)
{
    switch ($tgl){

        case 1: 

            return "Januari";

            break;

        case 2:

            return "Februari";

            break;

        case 3:

            return "Maret";

            break;

        case 4:

            return "April";

            break;

        case 5:

            return "Mei";

            break;

        case 6:

            return "Juni";

            break;

        case 7:

            return "Juli";

            break;

        case 8:

            return "Agustus";

            break;

        case 9:

            return "September";

            break;

        case 10:

            return "Oktober";

            break;

        case 11:

            return "November";

            break;

        case 12:

            return "Desember";

            break;

}
}

function getHours($jam){
    $dt = new Carbon($jam);
    return $dt->format('H:i:s');
}

function toHours($jam){
    $hours = floor($jam / 60);
    $min = $jam - ($hours * 60);
    return $hours.":".$min." "."menit";
}

// class Helper
// {
// 	public static function keIndonesia($tgl)
// 	{
// 		$dt = new Carbon($tgl);
// 		setlocale(LC_TIME, 'IND');
		
// 		return $dt->formatLocalized('%d %B %Y %H:%M:%S');
//     } 
    // public static function day($tgl)
    // {
    //     $dt = new Carbon($tgl);
    //     return $dt->day;
    // }
// }