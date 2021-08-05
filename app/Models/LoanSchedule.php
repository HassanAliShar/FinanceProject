<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'principal_payment',
        'interest_payment',
        'expected_payment',
        'expected_payment_date'
    ];
}
