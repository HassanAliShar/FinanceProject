<?php

namespace App\Imports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LoanImport implements ToModel,WithHeadingRow
{
    public $borrower_id;
    public function __construct($borrower_id) {
        $this->borrower_id = $borrower_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Loan([
            'borrower_id' => $this->borrower_id,
            'lender_name' => $row['lender_name'],
            'legal_loan_id' => $row['legal_loan_id'],
            'loan_type' => $row['loan_type'],
            'start_date' => Date::excelToDateTimeObject($row['start_date']),
            'end_date' => Date::excelToDateTimeObject($row['end_date']),
            'interest_type' => $row['interest_type'],
            'interest_rate' => $row['interest_rate'],
            'initial_amount' => $row['initial_amount'],
            'tenor' => $row['tenor'],
            'payment_period' => $row['payment_period'],
            'provision_charges' => $row['provision_charges'],
            'insurance_charges' => $row['insurance_charges'],
            'notary_charges' => $row['notary_charges'],
            'collateral' => $row['collateral'],
            'bank_account' => $row['bank_account']
        ]);
    }
}
