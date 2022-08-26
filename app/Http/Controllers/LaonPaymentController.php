<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Imports\PaymentImport;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanPaymentApprovel;
use App\Models\LoanSchduleApprovel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaonPaymentController extends Controller
{
    public function index(){

    }
    public function create($id){
        return view('director.loan.payment.add',['id'=>$id]);
    }

    public function store(Request $request,$id){
        // return $request;
        DB::beginTransaction();
        $payment = new LoanPayment();
        $payment->loan_id = $id;
        $payment->payment_amount = $request->payment_amount;
        $payment->interest_amount = $request->interest_amount;
        $payment->payment_date = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $payment->payment_note = $request->payment_note;
        if($payment->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Payment Added Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Payment Not Added');
        }
    }

    public function edit($id){
        return view('director.loan.payment.edit',['data'=>LoanPayment::find($id)]);
    }

    public function update(Request $request,$id){
        DB::beginTransaction();
        $payment = LoanPayment::find($id);
        $payment->payment_amount = $request->payment_amount;
        $payment->interest_amount = $request->interest_amount;
        $payment->payment_date = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $payment->payment_note = $request->payment_note;
        if($payment->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Payment Updated Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Payment Not Updated');
        }
    }

    public function destory($id){
        $payment = LoanPayment::find($id);

        if($payment->delete()){
            return redirect()->back()->with('success','Loan Payment Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Loan Payment Not Deleted');
        }
    }

    public function show($id){
        return view('director.loan.payment.view',['data'=>LoanPayment::find($id)]);
    }

    public function requested_payment(){
        return view('director.loan.payment.requested',['data'=>LoanPaymentApprovel::with('loan.borrower')->where('status','Pending')->get()]);
    }

    public function approve_request($id){
        $request = LoanPaymentApprovel::find($id);
        // dd($request);
        if($request->type == "Insert"){
            DB::beginTransaction();
            $payment = new LoanPayment();
            $payment->loan_id = $request->loan_id;
            $payment->payment_amount = $request->payment_amount;
            $payment->interest_amount = $request->interest_amount;
            $payment->payment_date = $request->payment_date;
            $payment->payment_note = $request->payment_note;
            if($payment->save()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Payment Add Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Payment Add Request Not Approved');
            }
        }
        else if($request->type == "Update"){
            DB::beginTransaction();
            $payment = LoanPayment::find($request->payment_id);
            $payment->payment_amount = $request->payment_amount;
            $payment->interest_amount = $request->interest_amount;
            $payment->payment_date = $request->payment_date;
            $payment->payment_note = $request->payment_note;
            if($payment->save()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Payment Updated Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Payment Request Not Approved');
            }
        }
        else{
            $payment = LoanPayment::find($request->payment_id);
            if($payment->delete()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Payment Deleted Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Payment Not Deleted');
            }
        }
    }

    public function reject_request($id){
        $request = LoanPaymentApprovel::find($id);
        $request->status = "Rejected";
        if($request->save()){
            return redirect()->back()->with('success',$request->type.'Request Rejected Successfully');
        }
        else{
            return redirect()->back()->with('success',$request->type.'Request Not Reject');
        }
    }

    public function staff_manage(){
        return view('staff.loan.payment.index',['data'=>LoanPayment::all()]);
    }
    public function staff_viwe($id){
        return view('staff.loan.payment.view_payment',['data'=>LoanPayment::find($id)]);
    }

    public function import_payment(Request $request){
        try{

            Excel::import(new PaymentImport($request->loan_id), $request->excel_file);
            return redirect()->back()->with('success','Payment File Imported Successfully');

        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }

    public function export_payment($id){
        try{
            $loan = Loan::find($id);
            return Excel::download(new PaymentExport($loan->lender_name,$loan->legal_loan_id,$id), 'Payment-'.Carbon::now()->format('d-m-Y').'.xlsx');
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }
}
