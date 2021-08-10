<?php

namespace App\Exports;

use App\Models\LoanPayment;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LoanPayment::all();
    }
}
