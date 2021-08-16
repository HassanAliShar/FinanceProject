<?php

namespace App\Http\Controllers;

use App\Exports\LoanExport;
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
use Carbon\Carbon;
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
        $loan->loan_internal_number = $request->loan_internal_number;
        $loan->loan_type = $request->loan_type;
        $loan->loan_status = $request->loan_status;
        $loan->loan_reason = $request->loan_reason;
        $loan->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $loan->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $loan->interest_type = $request->interest_type;
        $loan->interest_rate = $request->interest_rate;
        $loan->initial_amount = $request->initial_amount;
        $loan->tenor = $request->tenor;
        $loan->payment_period = $request->payment_period;
        $loan->administration_charges = $request->administration_charges;
        $loan->government_charges = $request->government_charges;
        $loan->agreement_charges = $request->agreement_charges;
        $loan->provision_charges = $request->provision_charges;
        $loan->skmht_charges = $request->skmht_charges;
        $loan->apht_charges = $request->apht_charges;
        $loan->fiduciary_charges = $request->fiduciary_charges;
        $loan->certificate_charges = $request->certificate_charges;
        $loan->other_charges = $request->other_charges;
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

    public function view_requested_loan($id)
    {
        return view('director.loan.view_requested_loan',['data'=>LoanApprovel::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
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
        try{
            DB::beginTransaction();
            $loan = Loan::find($id);
            $loan->borrower_id = $request->borrower_id;
            $loan->lender_name = $request->lender_name;
            $loan->legal_loan_id = $request->legal_loan_id;
            $loan->loan_internal_number = $request->loan_internal_number;
            $loan->loan_type = $request->loan_type;
            $loan->loan_status = $request->loan_status;
            $loan->loan_reason = $request->loan_reason;
            $loan->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $loan->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
            $loan->interest_type = $request->interest_type;
            $loan->interest_rate = $request->interest_rate;
            $loan->initial_amount = $request->initial_amount;
            $loan->tenor = $request->tenor;
            $loan->payment_period = $request->payment_period;
            $loan->administration_charges = $request->administration_charges;
            $loan->government_charges = $request->government_charges;
            $loan->agreement_charges = $request->agreement_charges;
            $loan->provision_charges = $request->provision_charges;
            $loan->skmht_charges = $request->skmht_charges;
            $loan->apht_charges = $request->apht_charges;
            $loan->fiduciary_charges = $request->fiduciary_charges;
            $loan->certificate_charges = $request->certificate_charges;
            $loan->other_charges = $request->other_charges;
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
                $loan->files->each(function($files) use($request) {
                    if(!in_array($files->value,$request->file_status))
                        $files->delete();
                });
                if($request->file_value != null){
                    // for($v = 0; $v<count($request->file_name); $v++){
                    //     $files = new BorrowerFile();
                    //     $files->name = $request->file_name[$v];
                    //     $fileName[$v] = Str::random(30).'.'.$request->file_value[$v]->extension();
                    //     $request->file_value[$v]->move(public_path('BorrowerFiles'), $fileName[$v]);
                    //     $files->value = $fileName[$v];
                    //     if(!$borrower->files()->save($files)){
                    //         DB::rollback();
                    //         return redirect()->back()->with('error','Borrower File Not Updated');
                    //     }
                    // }

                    foreach ($request->file_value as $v => $value) {
                        $files = LoanFile::where('value',$value)->first();
                        if($files == null)
                            $files = new LoanFile();
                        $v = (int)$v;
                        $files->name = $request->file_name[$v];
                        $fileName[$v] = Str::random(30).'.'.$request->file_value[$v]->extension();
                        $request->file_value[$v]->move(public_path('LoanFiles'), $fileName[$v]);
                        $files->value = $fileName[$v];
                        if(!$loan->files()->save($files)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower File Not Updated');
                        }
                    }
                }
                DB::commit();
                return redirect()->back()->with('success','Laon Updated Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Not Updated');
            }
        }
        catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
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
        try{
            DB::beginTransaction();
            $request = LoanApprovel::find($id);
            if($request->type == "Insert"){
                $loan = new Loan();
                $loan->borrower_id = $request->borrower_id;
                $loan->lender_name = $request->lender_name;
                $loan->legal_loan_id = $request->legal_loan_id;
                $loan->loan_internal_number = $request->loan_internal_number;
                $loan->loan_type = $request->loan_type;
                $loan->loan_status = $request->loan_status;
                $loan->loan_reason = $request->loan_reason;
                $loan->start_date = $request->start_date;
                $loan->end_date = $request->end_date;
                $loan->interest_type = $request->interest_type;
                $loan->interest_rate = $request->interest_rate;
                $loan->initial_amount = $request->initial_amount;
                $loan->tenor = $request->tenor;
                $loan->payment_period = $request->payment_period;
                $loan->administration_charges = $request->administration_charges;
                $loan->government_charges = $request->government_charges;
                $loan->agreement_charges = $request->agreement_charges;
                $loan->provision_charges = $request->provision_charges;
                $loan->skmht_charges = $request->skmht_charges;
                $loan->apht_charges = $request->apht_charges;
                $loan->fiduciary_charges = $request->fiduciary_charges;
                $loan->certificate_charges = $request->certificate_charges;
                $loan->other_charges = $request->other_charges;
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
            else if($request->type =="Update"){
                // DB::beginTransaction();
                $loan = Loan::find($request->loan_id);
                $loan->borrower_id = $request->borrower_id;
                $loan->lender_name = $request->lender_name;
                $loan->legal_loan_id = $request->legal_loan_id;
                $loan->loan_internal_number = $request->loan_internal_number;
                $loan->loan_type = $request->loan_type;
                $loan->loan_status = $request->loan_status;
                $loan->loan_reason = $request->loan_reason;
                $loan->start_date =  $request->start_date;
                $loan->end_date = $request->end_date;
                $loan->interest_type = $request->interest_type;
                $loan->interest_rate = $request->interest_rate;
                $loan->initial_amount = $request->initial_amount;
                $loan->tenor = $request->tenor;
                $loan->payment_period = $request->payment_period;
                $loan->administration_charges = $request->administration_charges;
                $loan->government_charges = $request->government_charges;
                $loan->agreement_charges = $request->agreement_charges;
                $loan->provision_charges = $request->provision_charges;
                $loan->skmht_charges = $request->skmht_charges;
                $loan->apht_charges = $request->apht_charges;
                $loan->fiduciary_charges = $request->fiduciary_charges;
                $loan->certificate_charges = $request->certificate_charges;
                $loan->other_charges = $request->other_charges;
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
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
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
        $loan_payment = Loan::find($id)->initial_amount;
        $schedule = LoanSchedule::where('loan_id',$id)->where('status',1)->sum('principal_payment');
        $outstanding_balance = $loan_payment - $schedule;
        $loan = Loan::find($id);
        $borrower_name = Borrower::find($loan->borrower_id)->name;
        $legal_loan_id = Loan::find($id)->legal_loan_id;
        // return LoanSchedule::where('loan_id',$id)->get();
        return view('director.loan.schdule.manage_schdule',['data'=>LoanSchedule::where('loan_id',$id)->get(),'id'=>$id, 'loan'=> Loan::all(),'data_payment'=>LoanPayment::where('loan_id',$id)->get(),'id'=>$id,'outstanding_balance'=>$outstanding_balance,'schdule'=>$schedule,'loan_payment'=>$loan_payment,'legal_loan_id'=>$legal_loan_id,'borrower_name'=>$borrower_name]);
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

    public function export_loan()
    {
        try{
            return Excel::download(new LoanExport, 'LOANDATA-'.Carbon::now()->format('d-m-Y').'.xlsx');
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }

    }

}
