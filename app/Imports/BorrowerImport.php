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
            'status' => $row['status'],
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
            'approved' => $row['approved'],
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
