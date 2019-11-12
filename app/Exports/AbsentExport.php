<?php

namespace App\Exports;

use App\Check_ins;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsentExport implements FromView, ShouldAutoSize
{
    protected $check_ins;
    protected $month;
    protected $year;
    
    public function __construct($check_ins, $month, $year)
    {
        $this->check_ins = $check_ins;
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        //LOAD VIEW transaction.blade.php DAN PASSING DATA YANG DIMINTA DIATAS
        return view('exports.absen', [
            'user' => User::all(),
            'check_ins' => $this->check_ins,
            'month' => $this->month,
            'year' => $this->year
        ]);
    }

    
}
