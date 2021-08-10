<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeData($query){
        $date = Carbon::now();
        return $query->where('expected_payment_date', '<', $date);
    }

    public function scopeGetStatus()
    {
        // $schdule = LoanSchedule::data()->get();
        $new_date = Carbon::today()->format('Y-m-d');
        $today = Carbon::parse($new_date);
        $expected = Carbon::parse($this->expected_payment_date);

        // $schdule_date = $expected->diff($today)->days;
        $schdule_date = $today->diff($expected)->days;


        // echo $this->status;

        // if($schdule_date > 10){
        if($this->status == 0){
            if($today > $expected){
                if($schdule_date > 180 ){
                    return '<span class="badge badge-danger badge-pill">Bad and Restructuring</span>';
                }
                if($schdule_date > 120 ){
                    return '<span class="badge badge-warning badge-pill">Doubtful</span>';
                }
                if($schdule_date > 90){
                    return '<span class="badge badge-secondary badge-pill">Substandard</span>';
                }
                if($schdule_date >10){
                    return '<span class="badge badge-primary badge-pill">Special Attention</span>';
                }
            }
            else{
                return 'Current';
            }
        }
        else{
            return '<span class="badge badge-success badge-pill">Paid</span>';
        }

    }
}
