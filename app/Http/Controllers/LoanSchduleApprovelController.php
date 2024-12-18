<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanSchduleApprovel;
use App\Models\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanSchduleApprovelController extends Controller
{
    public function index(){

    }
    public function create($id){
        return view('manager.loan.schdule.loan-schdule',['id'=>$id]);
    }

    public function store(Request $request,$id){
        // return $request;
        DB::beginTransaction();
        $schdule = new LoanSchduleApprovel();
        $schdule->loan_id = $id;
        $schdule->principal_payment = $request->principal_payment;
        $schdule->interest_payment = $request->interest_payment;
        $schdule->expected_payment = $request->expected_payment;
        $schdule->expected_payment_date = Carbon::createFromFormat('d/m/Y', $request->expected_payment_date)->format('Y-m-d');
        $schdule->status = 'Pending';
        $schdule->type = 'Insert';
        $schdule->user_id = Auth::user()->id;
        if($schdule->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Schedule Added Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Schedule Not Added');
        }
    }

    public function edit($id){
        return view('manager.loan.schdule.edit-schdule',['data'=>LoanSchedule::find($id)]);
    }

    public function update(Request $request,$id){
        DB::beginTransaction();
        $schdule = new LoanSchduleApprovel();
        $schdule->schdule_id = $id;
        $schdule->loan_id = $request->loan_id;
        $schdule->principal_payment = $request->principal_payment;
        $schdule->interest_payment = $request->interest_payment;
        $schdule->expected_payment = $request->expected_payment;
        $schdule->expected_payment_date = Carbon::createFromFormat('d/m/Y', $request->expected_payment_date)->format('Y-m-d');
        $schdule->status = 'Pending';
        $schdule->type = 'Update';
        $schdule->user_id = Auth::user()->id;
        if($schdule->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Schedule Update Request sent');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Schedule Update Request Not Sent');
        }
    }

    public function destory($id){
        DB::beginTransaction();
        $dt_schdule = LoanSchedule::find($id);
        $schdule = new LoanSchduleApprovel();
        $schdule->schdule_id = $id;
        $schdule->loan_id = $dt_schdule->loan_id;
        $schdule->principal_payment = $dt_schdule->principal_payment;
        $schdule->interest_payment = $dt_schdule->interest_payment;
        $schdule->expected_payment = $dt_schdule->expected_payment;
        $schdule->expected_payment_date = $dt_schdule->expected_payment_date;
        $schdule->status = 'Pending';
        $schdule->type = 'Delete';
        $schdule->user_id = Auth::user()->id;
        if($schdule->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Schedule Delete Request sent');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Schedule Delete Request Not Sent');
        }

    }

    public function show($id){
        return view('manager.loan.schdule.view',['data'=>LoanSchedule::find($id)]);
    }

    public function schedule($id)
    {
        $loan_payment = Loan::find($id)->initial_amount;
        $schedule = LoanSchedule::where('loan_id',$id)->where('status',1)->sum('principal_payment');
        $outstanding_balance = $loan_payment - $schedule;
        $loan = Loan::find($id);
        $borrower_name = Borrower::find($loan->borrower_id)->name;
        $legal_loan_id = Loan::find($id)->legal_loan_id;
        return view('manager.loan.schdule.manage_schdule',['data'=>LoanSchedule::where('loan_id',$id)->get(),'id'=>$id, 'loan'=> Loan::all(),'data_payment'=>LoanPayment::where('loan_id',$id)->get(),'id'=>$id,'outstanding_balance'=>$outstanding_balance,'schdule'=>$schedule,'loan_payment'=>$loan_payment,'legal_loan_id'=>$legal_loan_id,'borrower_name'=>$borrower_name]);
    }
    // REquested Schdule function
    public function requested_schdule(){
        return view('manager.loan.schdule.requested',['data'=>LoanSchduleApprovel::where('user_id',Auth::user()->id)->get()]);
    }
    // view Requested Schdule function
    public function view_schdule($id){
        return view('manager.loan.schdule.requested_view',['data'=>LoanSchduleApprovel::find($id)]);
    }
    // Delete Requested Schdule function
    public function delete_schdule($id){
        $schdule = LoanSchduleApprovel::find($id);
        if($schdule->delete()){
            return redirect()->back()->with('success','Loan Requested Schdule Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Loan Requested Schdule Not Deleted');
        }
    }
}
