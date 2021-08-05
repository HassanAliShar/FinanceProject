<?php

namespace App\Http\Controllers;

use App\Imports\LoanImport;
use App\Imports\UsersImport;
use App\Models\Loan;
use App\Models\Borrower;
use App\Models\LoanFile;
use App\Models\LoanField;
use App\Models\LoanPayment;
use Illuminate\Support\Str;
use App\Models\LoanApprovel;
use App\Models\LoanSchedule;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Broadcast;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('director.loan.manage',['data'=>Loan::all(),'borrower'=>Borrower::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('director.loan.add',['data'=>Borrower::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $loan = new Loan();
        $loan->borrower_id = $request->borrower_id;
        $loan->lender_name = $request->lender_name;
        $loan->legal_loan_id = $request->legal_loan_id;
        $loan->loan_type = $request->loan_type;
        $loan->start_date = $request->start_date;
        $loan->end_date = $request->end_date;
        $loan->interest_type = $request->interest_type;
        $loan->interest_rate = $request->interest_rate;
        $loan->initial_amount = $request->initial_amount;
        $loan->tenor = $request->tenor;
        $loan->payment_period = $request->payment_period;
        $loan->provision_charges = $request->provision_charges;
        $loan->insurance_charges = $request->insurance_charges;
        $loan->notary_charges = $request->notary_charges;
        $loan->collateral = $request->collateral;
        $loan->bank_account = $request->bank_account;

        if($loan->save()){
            if($request->field_name != null){
                for($i = 0; $i<count($request->field_name); $i++){
                    $fields = new LoanField();
                    $fields->name = $request->field_name[$i];
                    $fields->value = $request->field_value[$i];
                    if(!$loan->fields()->save($fields)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower Not Added');
                    }
                }
            }
            if($request->file_name != null){
                for($i = 0; $i<count($request->file_name); $i++){
                    $fields = new LoanFile();
                    $fields->name = $request->file_name[$i];
                    $fileName[$i] = Str::random(30).'.'.$request->file_value[$i]->extension();
                    $request->file_value[$i]->move(public_path('LoanFiles'), $fileName[$i]);
                    $fields->value = $fileName[$i];
                    if(!$loan->files()->save($fields)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower File Not Added');
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success','Laon Added Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_view($id)
    {
        return view('director.loan.view',['data'=>Loan::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('director.loan.edit',['data'=>Loan::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $loan = Loan::find($id);
        $loan->lender_name = $request->lender_name;
        $loan->legal_loan_id = $request->legal_loan_id;
        $loan->loan_type = $request->loan_type;
        $loan->start_date = $request->start_date;
        $loan->end_date = $request->end_date;
        $loan->interest_type = $request->interest_type;
        $loan->interest_rate = $request->interest_rate;
        $loan->initial_amount = $request->initial_amount;
        $loan->tenor = $request->tenor;
        $loan->payment_period = $request->payment_period;
        $loan->provision_charges = $request->provision_charges;
        $loan->insurance_charges = $request->insurance_charges;
        $loan->notary_charges = $request->notary_charges;
        $loan->collateral = $request->collateral;
        $loan->bank_account = $request->bank_account;

        if($loan->save()){
            $loan->fields->each(function($field) {
                $field->delete();
            });

            if($request->field_name != null){
                for($i = 0; $i<count($request->field_name); $i++){
                    $fields = new LoanField();
                    $fields->name = $request->field_name[$i];
                    $fields->value = $request->field_value[$i];
                    if(!$loan->fields()->save($fields)){
                        DB::rollback();
                        return redirect()->back()->with('error','Loan Not Added');
                    }
                }
            }
            // $loan->files->each(function($files) {
            //     $files->delete();
            // });
            // if($request->file_name != null){
            //     for($v = 0; $v<count($request->file_name); $v++){
            //         echo $request->file_value;
            //         $files = new LoanFile();
            //         $files->name = $request->file_name[$v];
            //         $fileName[$v] = Str::random(30).'.'.$request->file_value[$v]->extension();
            //         $request->file_value[$v]->move(public_path('LoanFiles'), $fileName[$v]);
            //         $files->value = $fileName[$v];
            //         if(!$loan->files()->save($files)){
            //             DB::rollback();
            //             return redirect()->back()->with('error','Loan File Not Updated');
            //         }
            //     }
            // }
            DB::commit();
            return redirect()->back()->with('success','Laon Updated Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Loan Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);
        if($loan->delete()){
            return redirect()->back()->with('success','Laon Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Laon Not Deleted');
        }
    }

    public function requested_loan(){
        return view('director.loan.requested',['data'=>LoanApprovel::where('status','Pending')->get()]);
    }

    public function approve_loan($id){
        DB::beginTransaction();
        $request = LoanApprovel::find($id);
        if($request->type == "Insert"){
            $loan = new Loan();
            $loan->borrower_id = $request->borrower_id;
            $loan->lender_name = $request->lender_name;
            $loan->legal_loan_id = $request->legal_loan_id;
            $loan->loan_type = $request->loan_type;
            $loan->start_date = $request->start_date;
            $loan->end_date = $request->end_date;
            $loan->interest_type = $request->interest_type;
            $loan->interest_rate = $request->interest_rate;
            $loan->initial_amount = $request->initial_amount;
            $loan->tenor = $request->tenor;
            $loan->payment_period = $request->payment_period;
            $loan->provision_charges = $request->provision_charges;
            $loan->insurance_charges = $request->insurance_charges;
            $loan->notary_charges = $request->notary_charges;
            $loan->collateral = $request->collateral;
            $loan->bank_account = $request->bank_account;

            if($loan->save()){
                if($request->fields != null){
                    foreach($request->fields as $row){
                        $fields = new LoanField();
                        $fields->name = $row->name;
                        $fields->value = $row->value;
                        if(!$loan->fields()->save($fields)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Added');
                        }
                    }
                }
                if($request->files != null){
                    foreach($request->files as $file_row){
                        $files = new LoanFile();
                        $files->name = $file_row->name;
                        $files->value = $file_row->value;
                        if(!$loan->files()->save($files)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Added');
                        }
                    }
                }
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Loan Requested Approved Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Requested Not Approved');
            }
        }
        else if($request->type =="Updated"){
            DB::beginTransaction();
            $loan = Loan::find($request->loan_id);
            $loan->lender_name = $request->lender_name;
            $loan->legal_loan_id = $request->legal_loan_id;
            $loan->loan_type = $request->loan_type;
            $loan->start_date = $request->start_date;
            $loan->end_date = $request->end_date;
            $loan->interest_type = $request->interest_type;
            $loan->interest_rate = $request->interest_rate;
            $loan->initial_amount = $request->initial_amount;
            $loan->tenor = $request->tenor;
            $loan->payment_period = $request->payment_period;
            $loan->provision_charges = $request->provision_charges;
            $loan->insurance_charges = $request->insurance_charges;
            $loan->notary_charges = $request->notary_charges;
            $loan->collateral = $request->collateral;
            $loan->bank_account = $request->bank_account;

            if($loan->save()){
                $loan->fields->each(function($field) {
                    $field->delete();
                });

                if($request->fields != null){
                    foreach($request->fields as $row){
                        $fields = new LoanField();
                        $fields->name = $row->name;
                        $fields->value = $row->value;
                        if(!$loan->fields()->save($fields)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Updated');
                        }
                    }
                }
                $loan->files->each(function($files) {
                    $files->delete();
                });
                if($request->files != null){
                    foreach($request->files as $file_row){
                        $files = new LoanFile();
                        $files->name = $file_row->name;
                        $files->value = $file_row->value;
                        if(!$loan->files()->save($files)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Added');
                        }
                    }
                }
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Laon Updated Rqueested Approved Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Updated Reqeust Not Approved');
            }
        }
        else{

            $loan = Loan::find($request->loan_id);

            if($loan->delete()){
                $request->status = "Approved";
                $request->save();
                DB::commit();
                return redirect()->back()->with('success','Laon Deleted Request Approved');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Laon Delete Request Not Approved');
            }
        }

    }

    public function reject_loan($id){
        $request = LoanApprovel::find($id);
        $request->status = "Rejected";
        if($request->save()){
            return redirect()->back()->with('success',$request->type.'Request Rejected Successfully');
        }
        else{
            return redirect()->back()->with('success',$request->type.'Request Not Reject');
        }
    }

    public function schedule($id)
    {
        return view('director.loan.schdule.manage_schdule',['data'=>LoanSchedule::where('loan_id',$id)->get(),'id'=>$id, 'loan'=> Loan::all()]);
    }

    public function payments($id)
    {
        return view('director.loan.payment.manage',['data'=>LoanPayment::where('loan_id',$id)->get(),'id'=>$id]);
    }


    public function staff_manage(){
        return view('staff.loan.index',['data'=>Loan::all()]);
    }

    public function staff_viwe($id){
        return view('staff.loan.view_data',['data'=>Loan::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
    }

    public function import_loan(Request $request){
        try{
            Excel::import(new LoanImport($request->borrower_id), $request->excel_file);
            return redirect()->back()->with('success', 'File Imported Successfully');
        }
        catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }
}
