<?php

namespace App\Http\Controllers;

use App\Imports\SchduleImport;
use App\Models\LoanSchduleApprovel;
use App\Models\LoanSchedule;
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
        $schdule->expected_payment_date = $request->expected_payment_date;
        if($schdule->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Schdule Added Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Schdule Not Added');
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
        $schdule->expected_payment_date = $request->expected_payment_date;
        if($schdule->save()){
            DB::commit();
            return redirect()->back()->with('success','Loan Schdule Update Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Schdule Not Update');
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
            $schdule->expected_payment_date = $request->expected_payment_date;
            if($schdule->save()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Schdule Added Requted Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Schdule Request Not Approved');
            }
        }
        else if($request->type =="Update"){
            DB::beginTransaction();
            $schdule = LoanSchedule::find($request->schdule_id);
            $schdule->principal_payment = $request->principal_payment;
            $schdule->interest_payment = $request->interest_payment;
            $schdule->expected_payment = $request->expected_payment;
            $schdule->expected_payment_date = $request->expected_payment_date;
            if($schdule->save()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Schdule Update Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Schdule Update Not Approved');
            }
        }
        else{
            $schdule = LoanSchedule::find($request->schdule_id);
            if($schdule->delete()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Schdule Deleted Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Schdule Request Not Approved');
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
            return redirect()->back()->with('success','Loan Schdule Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Loan Schdule Not Deleted');
        }
    }

    public function show($id){
        return view('director.loan.schdule.view',['data'=>LoanSchedule::find($id)]);
    }

    public function staff_manage($id){
        return view('staff.loan.schdule.index',['data'=>LoanSchedule::where('loan_id',$id)->get()]);
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
}
