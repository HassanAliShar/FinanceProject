<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LoanExport implements FromCollection,WithHeadingRow
{
    public function headings(): array
    {
        return [
            '#',
            'borrower_id',
            'lender_name',
            'legal_loan_id',
            'loan_internal_number',
            'loan_type',
            'loan_status',
            'loan_reason',
            'start_date',
            'end_date',
            'interest_type',
            'interest_rate',
            'initial_amount',
            'tenor',
            'payment_period',
            'administration_charges',
            'government_charges',
            'agreement_charges',
            'provision_charges',
            'skmht_charges',
            'apht_charges',
            'fiduciary_charges',
            'certificate_charges',
            'other_charges',
            'insurance_charges',
            'notary_charges',
            'collateral',
            'bank_account',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Loan::all();
    }

}
