<?php

namespace App\Exports;

use App\Models\Borrower;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BorrowerExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            ['Borrower Data of', env('APP_NAME')],
            ['Date Time', Carbon::now()->format('d-m-Y H-i-s')],
            [],
            ['#',
            'name',
            'internal_number',
            'identity_no',
            'identity_type',
            'nationality',
            'place_of_birth',
            'dob',
            'last_education',
            'mother_maiden',
            'surveyor',
            'partner_spouse',
            'partner_spouse_identity_number',
            'partner_spouse_contact_number',
            'partner_spouse_domicile_address',
            'marriage_status',
            'family_card_number',
            'home_number',
            'mobile_number',
            'office_number',
            'domicile_status',
            'email',
            'status',
            'tax_identity_no',
            'borrower_type',
            'person_in_contact',
            'reference',
            'identity_address',
            'domicile_address',
            'office_address',
            'occupation',
            'line_of_business',
            'business_experience',
            'business_capital',
            'annual_income',
            'other_income',
            'joint_income',
            'total_income',
            'living_expenses',
            'business_expenses',
            'other_expenses',
            'other_loan',
            'net_cash_flow',
            'total_assets',
            'other_lenders',
            'bank_account',
            'approved',
            'created_by',
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
        return Borrower::all();
    }
}
