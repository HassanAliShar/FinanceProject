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
        'bank_account',
        'approved',
        'created_by'
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
