<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowerApproval extends Model
{
    use HasFactory;


    public function fields()
    {
        return $this->hasMany(BorrowerFieldApproval::class);
    }

    public function files()
    {
        return $this->hasMany(BorrowerFileApproval::class);
    }
}
