<?php

namespace App\Exports;

use App\Models\LoanPayment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentExport implements FromCollection, WithHeadings
{
    public $loan_name;
    public $loan_id;

    public function __construct($loan_name,$loan_id) {
        $this->loan_name = $loan_name;
        $this->loan_id = $loan_id;
    }
    public function headings(): array
    {
        return [
            ['Payment Data Of ', env('APP_NAME')],
            ['Legal Loan ID', $this->loan_id],
            ['Loan Name', $this->loan_name],
            ['Date Time', Carbon::now()->format('d-m-Y H-i-s')],
            [],
            ['#',
            'loan_id',
            'payment_amount',
            'interest_amount',
            'payment_date',
            'payment_note',
            'created_at',
            'updated_at',
            ]
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LoanPayment::all();
    }
}
