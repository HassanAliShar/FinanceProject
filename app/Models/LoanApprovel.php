<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApprovel extends Model
{
    use HasFactory;

    public function fields()
    {
        return $this->hasMany(LoanFieldApprovel::class);
    }

    public function files()
    {
        return $this->hasMany(LoanFileApprovel::class);
    }
}
