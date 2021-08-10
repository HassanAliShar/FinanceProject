<?php

namespace App\Exports;

use App\Models\LoanSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;

class SchduelExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LoanSchedule::all();
    }
}
