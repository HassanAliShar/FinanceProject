<?php

use App\Models\BorrowerApproval;
use App\Models\LoanApprovel;
use App\Models\LoanPaymentApprovel;
use App\Models\LoanSchduleApprovel;
use App\Models\LoanSchedule;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;

function getStaffRoleId(){
    return 3;
}

function getManagerRoleId(){
    return 2;
}

function getDirectorRoleId(){
    return 1;
}

function getFooter(){
    return Setting::find(4)->value;
}

function getLogo(){
    return Setting::find(1)->value;
}

function getMessage(){
    return Setting::find(3)->value;
}

function getTitle(){
    return Setting::find(2)->value;
}

function all_borrowers(){
    return count(BorrowerApproval::where('status','Pending')->get());
}

function getAllLoansNotifications(){
    $loans = count(LoanApprovel::where('status','Pending')->get());
    $schdule = count(LoanSchduleApprovel::where('status','Pending')->get());
    $payment = count(LoanPaymentApprovel::where('status','Pending')->get());
    return $loans + $schdule + $payment;
}
function getLoanNotifications(){
    return count(LoanApprovel::where('status','Pending')->get());
}
function getSchduleNotifications(){
    return count(LoanSchduleApprovel::where('status','Pending')->get());
}
function getPaymentNotifications(){
    return count(LoanPaymentApprovel::where('status','Pending')->get());
}

/**
 * Determine if the uploaded data contains a file.
 *
 * @param  string  $key
 * @return bool
 */
function hasFile($key,$request)
{
    if (is_array($file = $request->file($key))) $file = head($file);

    return $file instanceof \SplFileInfo;
}


