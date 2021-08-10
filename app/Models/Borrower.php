<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'identity_no',
        'identity_type',
        'nationality',
        'dob',
        'tax_identity_no',
        'borrower_type',
        'person_in_contact',
        'reference',
        'identity_address',
        'domicile_address',
        'office_address',
        'occupation',
        'line_of_business',
        'bank_account',
        'internal_number',
        'place_of_birth',
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
        'identity_address',
        'domicile_address',
        'office_address',
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
        'status',
        'created_by',
    ];

    public function fields()
    {
        return $this->hasMany(BorrowerField::class);
    }

    public function files()
    {
        return $this->hasMany(BorrowerFile::class);
    }

}
