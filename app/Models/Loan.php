<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'bank_account'
    ];
    /**
     * Get the borrowers that owns the Loan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }
    public function fields()
    {
        return $this->hasMany(LoanField::class);
    }

    public function files()
    {
        return $this->hasMany(LoanFile::class);
    }

    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }

    public function outstanding_payment(){
        return $this->initial_amount - $this->payments->sum('payment_amount');
    }

}
