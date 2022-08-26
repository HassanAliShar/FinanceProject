<?php

namespace App\Http\Controllers;

use App\Models\LoanPayment;
use App\Models\LoanPaymentApprovel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanPaymentApprovelController extends Controller
{
    public function index(){
        return view('manager.loan.payment.requested',['data'=>LoanPaymentApprovel::with('loan.borrower')->where('user_id',Auth::user()->id)->get()]);
    }
    public function create($id){
        return view('manager.loan.payment.add',['id'=>$id]);
    }

    public function store(Request $request,$id){
        // return $request;
        DB::beginTransaction();
        $payment = new LoanPaymentApprovel();
        $payment->loan_id = $id;
        $payment->payment_amount = $request->payment_amount;
        $payment->interest_amount = $request->interest_amount;
        $payment->payment_date = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $payment->payment_note = $request->payment_note;
        $payment->status = 'Pending';
        $payment->user_id = Auth::user()->id;
        $payment->type = 'Insert';
        if($payment->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Payment Request Sent Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Payment Request Not Sent');
        }
    }

    public function edit($id){
        return view('manager.loan.payment.edit',['data'=>LoanPayment::find($id)]);
    }

    public function update(Request $request,$id){
        DB::beginTransaction();
        $payment = new LoanPaymentApprovel();
        $payment->payment_id = $id;
        $payment->loan_id = $request->loan_id;
        $payment->payment_amount = $request->payment_amount;
        $payment->interest_amount = $request->interest_amount;
        $payment->payment_date = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $payment->payment_note = $request->payment_note;
        $payment->status = "Pending";
        $payment->type = "Update";
        $payment->user_id = Auth::user()->id;
        if($payment->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Payment Updated Request Sent');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Payment Updated Not Sent');
        }
    }

    public function destory($id){
        DB::beginTransaction();
        $loanpayment = LoanPayment::find($id);
        $payment = new LoanPaymentApprovel();
        $payment->payment_id = $id;
        $payment->loan_id = $loanpayment->loan_id;
        $payment->payment_amount = $loanpayment->payment_amount;
        $payment->interest_amount = $loanpayment->interest_amount;
        $payment->payment_date = $loanpayment->payment_date;
        $payment->payment_note = $loanpayment->payment_note;
        $payment->status = "Pending";
        $payment->type = "Delete";
        $payment->user_id = Auth::user()->id;
        if($payment->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Payment Delete Request Sent');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Payment Delete Request Not Sent');
        }
    }

    public function show($id){
        return view('manager.loan.payment.view',['data'=>LoanPayment::find($id)]);
    }
    public function payments($id)
    {
        return view('manager.loan.payment.manage',['data'=>LoanPayment::where('loan_id',$id)->get(),'id'=>$id]);
    }
    public function delete_req($id){
        $requested = LoanPaymentApprovel::find($id);
        if($requested->delete()){
            return redirect()->back()->with('success','Request Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Request Not Deleted');
        }
    }

    public function show_view($id){
        return view('manager.loan.payment.requested_view',['data'=>LoanPaymentApprovel::find($id)]);
    }
}
