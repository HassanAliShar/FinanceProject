<?php

namespace App\Imports;

use App\Models\LoanPayment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PaymentImport implements ToModel,WithHeadingRow
{
    public $loan_id;
    public function __construct($loan_id) {
        $this->loan_id = $loan_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new LoanPayment([
            'loan_id' => $this->loan_id,
            'payment_amount' => $row['payment_amount'],
            'interest_amount' => $row['interest_amount'],
            'payment_date' => Date::excelToDateTimeObject($row['payment_date']),
            'payment_note' => $row['payment_note']
        ]);
    }
}
