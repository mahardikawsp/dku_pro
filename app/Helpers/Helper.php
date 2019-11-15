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

    function toHours($minutes){
        if($minutes <= 0) { 
            return '00 Jam 00 Menit';
        }else {    
            return sprintf("%02d",floor($minutes / 60)).' Jam '.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT)). " Menit";
        }
    }

    function acc($string)
    {
        if($string == 0) {
            return "Menunggu Persetujuan";
        } elseif ($string == 1){
            return "Terima";
        } elseif ($string == 2){
            return "Ditolak";
        }
    }