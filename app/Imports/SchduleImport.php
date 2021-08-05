<?php

namespace App\Imports;

use App\Models\LoanSchedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SchduleImport implements ToModel,WithHeadingRow
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
        return new LoanSchedule([
            'loan_id' => $this->loan_id,
            'principal_payment' => $row['principal_payment'],
            'interest_payment' => $row['interest_payment'],
            'expected_payment' => $row['expected_payment'],
            'expected_payment_date' => Date::excelToDateTimeObject($row['expected_payment_date']),
        ]);
    }
}
