<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    use HasFactory;
    protected $fillable =[
        'loan_id',
        'payment_amount',
        'interest_amount',
        'payment_date',
        'payment_note'
    ];
}
