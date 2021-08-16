<?php

namespace App\Http\Controllers;

use App\Exports\SchduelExport;
use App\Imports\SchduleImport;
use App\Models\Borrower;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\LoanSchduleApprovel;
use App\Models\LoanSchedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaonScheduleController extends Controller
{
    public function index(){

    }
    public function create($id){
        return view('director.loan.schdule.loan-schdule',['id'=>$id]);
    }

    public function store(Request $request,$id){
        // return $request;
        DB::beginTransaction();
        $schdule = new LoanSchedule();
        $schdule->loan_id = $id;
        $schdule->principal_payment = $request->principal_payment;
        $schdule->interest_payment = $request->interest_payment;
        $schdule->expected_payment = $request->expected_payment;
        $schdule->expected_payment_date = Carbon::createFromFormat('d/m/Y', $request->expected_payment_date)->format('Y-m-d');
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
        return view('director.loan.schdule.edit-schdule',['data'=>LoanSchedule::find($id)]);
    }

    public function update(Request $request,$id){
        DB::beginTransaction();
        $schdule = LoanSchedule::find($id);
        $schdule->principal_payment = $request->principal_payment;
        $schdule->interest_payment = $request->interest_payment;
        $schdule->expected_payment = $request->expected_payment;
        $schdule->expected_payment_date = Carbon::createFromFormat('d/m/Y', $request->expected_payment_date)->format('Y-m-d');
        if($schdule->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Schedule Update Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Schedule Not Update');
        }
    }

    public function requested_schdule(){
        return view('director.loan.schdule.requested',['data'=>LoanSchduleApprovel::where('status','Pending')->get()]);
    }

    public function approve_schdule($id){

        $request = LoanSchduleApprovel::find($id);
        // dd($request);
        if($request->type =="Insert"){
            DB::beginTransaction();
            $schdule = new LoanSchedule();
            $schdule->loan_id = $request->loan_id;
            $schdule->principal_payment = $request->principal_payment;
            $schdule->interest_payment = $request->interest_payment;
            $schdule->expected_payment = $request->expected_payment;
            $schdule->expected_payment_date =$request->expected_payment_date;
            if($schdule->save()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Schedule Added Requted Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Schedule Request Not Approved');
            }
        }
        else if($request->type =="Update"){
            DB::beginTransaction();
            $schdule = LoanSchedule::find($request->schdule_id);
            $schdule->principal_payment = $request->principal_payment;
            $schdule->interest_payment = $request->interest_payment;
            $schdule->expected_payment = $request->expected_payment;
            $schdule->expected_payment_date =  $request->expected_payment_date;
            if($schdule->save()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Schedule Update Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Schedule Update Not Approved');
            }
        }
        else{
            $schdule = LoanSchedule::find($request->schdule_id);
            if($schdule->delete()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Schedule Deleted Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Schedule Request Not Approved');
            }
        }
    }

    public function reject_schdule($id){

        $request = LoanSchduleApprovel::find($id);
        $request->status = "Rejected";
        if($request->save()){
            return redirect()->back()->with('success',$request->type.'Request Rejected Successfully');
        }
        else{
            return redirect()->back()->with('success',$request->type.'Request Not Reject');
        }
    }

    public function destory($id){
        $schdule = LoanSchedule::find($id);
        if($schdule->delete()){
            return redirect()->back()->with('success','Loan Schedule Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Loan Schedule Not Deleted');
        }
    }

    public function show($id){
        return view('director.loan.schdule.view',['data'=>LoanSchedule::find($id)]);
    }

    public function staff_manage($id){
        $loan_payment = Loan::find($id)->initial_amount;
        $schedule = LoanSchedule::where('loan_id',$id)->where('status',1)->sum('principal_payment');
        $outstanding_balance = $loan_payment - $schedule;
        $loan = Loan::find($id);
        $borrower_name = Borrower::find($loan->borrower_id)->name;
        $legal_loan_id = Loan::find($id)->legal_loan_id;
        return view('staff.loan.schdule.index',['data'=>LoanSchedule::where('loan_id',$id)->get(),'id'=>$id, 'loan'=> Loan::all(),'data_payment'=>LoanPayment::where('loan_id',$id)->get(),'id'=>$id,'outstanding_balance'=>$outstanding_balance,'schdule'=>$schedule,'loan_payment'=>$loan_payment,'legal_loan_id'=>$legal_loan_id,'borrower_name'=>$borrower_name]);
        // return view('staff.loan.schdule.index',['data'=>LoanSchedule::where('loan_id',$id)->get()]);
    }

    public function staff_viwe($id){
        return view('staff.loan.schdule.view_schdule',['data'=>LoanSchedule::find($id)]);
    }

    public function import_schdule(Request $request){
        try{
            Excel::import(new SchduleImport($request->loan_id),$request->excel_file);
            return redirect()->back()->with('success','Schdule File Imported Successfully');
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }

    public function schdule_paid($id){
       $schdule = LoanSchedule::find($id);
       $schdule->status = 1;
       if($schdule->save()){
           return redirect()->back()->with('success','Paid Successfully');
       }
       else{
           return redirect()->back()->with('error','Schdule Not Paid');
       }
    }

    public function export_schdule($id){
        try{

            $loan = Loan::find($id);
            return Excel::download(new SchduelExport($loan->lender_name,$loan->legal_loan_id), 'Schedule-'.Carbon::now()->format('d-m-Y').'.xlsx');

        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }
}
