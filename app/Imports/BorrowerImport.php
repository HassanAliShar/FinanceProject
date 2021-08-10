<?php

namespace App\Imports;

use DateTimeInterface;
use App\Models\Borrower;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class BorrowerImport implements ToModel,WithHeadingRow
{
    public $user_id;
    public function __construct($user_id) {
        $this->user_id = $user_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Borrower([
            'name' => $row['name'],
            'identity_no' => $row['identity_no'],
            'identity_type' => $row['identity_type'],
            'nationality' => $row['nationality'],
            'dob' => Date::excelToDateTimeObject($row['dob']),
            'tax_identity_no' => $row['tax_identity_no'],
            'borrower_type' => $row['borrower_type'],
            'person_in_contact' => $row['person_in_contact'],
            'reference' => $row['reference'],
            'identity_address' => $row['identity_address'],
            'domicile_address' => $row['domicile_address'],
            'office_address' => $row['office_address'],
            'occupation' => $row['occupation'],
            'line_of_business' => $row['line_of_business'],
            'bank_account' => $row['bank_account'],
            'internal_number' => $row['internal_number'],
            'place_of_birth' => $row['place_of_birth'],
            'last_education' => $row['last_education'],
            'mother_maiden' => $row['mother_maiden'],
            'surveyor' => $row['surveyor'],
            'partner_spouse' => $row['partner_spouse'],
            'partner_spouse_identity_number' => $row['partner_spouse_identity_number'],
            'partner_spouse_contact_number' => $row['partner_spouse_contact_number'],
            'partner_spouse_domicile_address' => $row['partner_spouse_domicile_address'],
            'marriage_status' => $row['marriage_status'],
            'family_card_number' => $row['family_card_number'],
            'home_number' => $row['home_number'],
            'mobile_number' => $row['mobile_number'],
            'office_number' => $row['office_number'],
            'domicile_status' => $row['domicile_status'],
            'email' => $row['email'],
            'identity_address' => $row['identity_address'],
            'domicile_address' => $row['domicile_address'],
            'office_address' => $row['office_address'],
            'line_of_business' => $row['line_of_business'],
            'business_experience' => $row['business_experience'],
            'business_capital' => $row['business_capital'],
            'annual_income' => $row['annual_income'],
            'other_income' => $row['other_income'],
            'joint_income' => $row['joint_income'],
            'total_income' => $row['total_income'],
            'living_expenses' => $row['living_expenses'],
            'business_expenses' => $row['business_expenses'],
            'other_expenses' => $row['other_expenses'],
            'other_loan' => $row['other_loan'],
            'net_cash_flow' => $row['net_cash_flow'],
            'total_assets' => $row['total_assets'],
            'other_lenders' => $row['other_lenders'],
            'status' => $row['status'],
            'created_by' => $this->user_id,
        ]);
    }
    // public function columnFormats(): array
    // {
    //     return [
    //         'dob' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    //     ];
    // }
}
