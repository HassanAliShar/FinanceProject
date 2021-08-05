<?php

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



