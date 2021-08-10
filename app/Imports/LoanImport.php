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
            'loan_internal_number' => $row['loan_internal_number'],
            'loan_type' => $row['loan_type'],
            'loan_status' => $row['loan_status'],
            'loan_reason' => $row['loan_reason'],
            'start_date' => Date::excelToDateTimeObject($row['start_date']),
            'end_date' => Date::excelToDateTimeObject($row['end_date']),
            'interest_type' => $row['interest_type'],
            'interest_rate' => $row['interest_rate'],
            'initial_amount' => $row['initial_amount'],
            'tenor' => $row['tenor'],
            'payment_period' => $row['payment_period'],
            'administration_charges' => $row['administration_charges'],
            'government_charges' => $row['government_charges'],
            'agreement_charges' => $row['agreement_charges'],
            'provision_charges' => $row['provision_charges'],
            'skmht_charges' => $row['skmht_charges'],
            'apht_charges' => $row['apht_charges'],
            'fiduciary_charges' => $row['fiduciary_charges'],
            'certificate_charges' => $row['certificate_charges'],
            'other_charges' => $row['other_charges'],
            'insurance_charges' => $row['insurance_charges'],
            'notary_charges' => $row['notary_charges'],
            'collateral' => $row['collateral'],
            'bank_account' => $row['bank_account'],
        ]);
    }
}
