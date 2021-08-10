<?php

namespace App\Http\Controllers;

use App\Models\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $today = Carbon::now();
        return view('director.dashboard',['data'=>LoanSchedule::all(),'late_payment'=>LoanSchedule::where('expected_payment_date','<',$today)->get()])->with('success',getMessage());
    }
}
