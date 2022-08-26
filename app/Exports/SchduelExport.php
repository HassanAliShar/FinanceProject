<?php

namespace App\Exports;

use App\Models\LoanSchedule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SchduelExport implements FromCollection,WithHeadings
{
    public $loan_name;
    public $loan_id;
    public $id;

    public function __construct($loan_name,$loan_id,$id) {
        $this->loan_name = $loan_name;
        $this->loan_id = $loan_id;
        $this->id = $id;
    }
    public function headings(): array
    {
        return [
            ['Schedule Data of', env('APP_NAME')],
            ['Legal Loan ID', $this->loan_id],
            ['Loan Name', $this->loan_name],
            ['Date Time', Carbon::now()->format('d-m-Y H-i-s')],
            [],
            ['#',
            'loan_id',
            'principal_payment',
            'interest_payment',
            'expected_payment',
            'expected_payment_date',
            'status',
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
        return LoanSchedule::where('loan_id',$this->id)->get();
    }
}
