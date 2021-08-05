<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowerFileApproval extends Model
{
    use HasFactory;


    public function borrower()
    {
        return $this->belongsTo(BorrowerApproval::class);
    }
}
