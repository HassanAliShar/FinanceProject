<?php

namespace App\Http\Controllers;

use App\Models\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role_id == getDirectorRoleId()){
            return redirect('/admin_dashboard');
        }
        if(Auth::user()->role_id == getManagerRoleId()){
            return redirect('/manager_dashboard');
        }
        if(Auth::user()->role_id == getStaffRoleId()){
            return redirect('/staff_dashboard');
        }

    }
}
