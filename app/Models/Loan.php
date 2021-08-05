<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_id',
        'lender_name',
        'legal_loan_id',
        'loan_type',
        'start_date',
        'end_date',
        'interest_type',
        'interest_rate',
        'initial_amount',
        'tenor',
        'payment_period',
        'provision_charges',
        'insurance_charges',
        'notary_charges',
        'collateral',
        'bank_account'
    ];
    public function fields()
    {
        return $this->hasMany(LoanField::class);
    }

    public function files()
    {
        return $this->hasMany(LoanFile::class);
    }

    public function borrowers()
    {
        return $this->hasMany(Borrower::class);
    }
}
