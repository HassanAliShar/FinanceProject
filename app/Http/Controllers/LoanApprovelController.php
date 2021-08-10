<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Borrower;
use Illuminate\Support\Str;
use App\Models\LoanApprovel;
use App\Models\LoanFieldApprovel;
use App\Models\LoanFileApprovel;
use App\Models\LoanSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoanPaymentApprovel;
use App\Models\LoanSchdaleApprovel;
use App\Models\LoanSchduleApprovel;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoanApprovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manager.loan.manage',['data'=> Loan::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.loan.add',['data'=>Borrower::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $loan = new LoanApprovel();
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

            $loan->status = 'Pending';
            $loan->type = 'Insert';
            $loan->user_id = Auth::user()->id;

            if($loan->save()){
                if($request->field_name != null){
                    for($i = 0; $i<count($request->field_name); $i++){
                        $fields = new LoanFieldApprovel();
                        $fields->name = $request->field_name[$i];
                        $fields->value = $request->field_value[$i];
                        if(!$loan->fields()->save($fields)){
                            DB::rollback();
                            return redirect()->back()->with('error','Loan Not Added');
                        }
                    }
                }
                if($request->file_name != null){
                    for($i = 0; $i<count($request->file_name); $i++){
                        $files = new LoanFileApprovel();
                        $files->name = $request->file_name[$i];
                        $fileName[$i] = Str::random(30).'.'.$request->file_value[$i]->extension();
                        $request->file_value[$i]->move(public_path('LoanFiles'), $fileName[$i]);
                        $files->value = $fileName[$i];
                        if(!$loan->files()->save($files)){
                            DB::rollback();
                            return redirect()->back()->with('error','Loan File Not Added');
                        }
                    }
                }
                DB::commit();
                return redirect()->back()->with('success','Laon Added Request sent Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Loan Request Not Added');
            }
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
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

        return view('manager.loan.view',['data'=>Loan::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
    }

    public function view_requested($id){
        return view('manager.loan.view_requested_loan',['data'=>LoanApprovel::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('manager.loan.edit',['data'=>Loan::with('fields')->with('files')->find($id),'borrower'=>Borrower::all()]);
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
            $loan = new LoanApprovel();
            $loan->loan_id = $request->loan_id;
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

            $loan->status = 'Pending';
            $loan->type = 'Update';
            $loan->user_id = Auth::user()->id;

            if($loan->save()){
                $loan->fields->each(function($field) {
                    $field->delete();
                });
                if($request->field_name != null){
                    for($i = 0; $i<count($request->field_name); $i++){
                        $fields = new LoanFieldApprovel();
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
                //     for($i = 0; $i<count($request->file_name); $i++){
                //         $files = new LoanFileApprovel();
                //         $files->name = $request->file_name[$i];
                //         $files->value = $request->file_value[$i];
                //         if(!$loan->files()->save($files)){
                //             DB::rollback();
                //             return redirect()->back()->with('error','Loan Not Added');
                //         }
                //     }
                // }
                DB::commit();
                return redirect()->back()->with('success','Laon Updated Request Send Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Laon Updated Request Not Send');
            }
        }catch(Exception $ex){
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
        $request = Loan::find($id);
        DB::beginTransaction();
        $loan = new LoanApprovel();
        $loan->loan_id = $request->id;
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
        $loan->status = 'Pending';
        $loan->type = 'Delete';
        $loan->user_id = Auth::user()->id;

        if($loan->save()){
            DB::commit();
            return redirect()->back()->with('success','Laon Delete Request Send Successfully');
        }
        else{
            DB::rollBack();
            return redirect()->back()->with('error','Laon Delete Request Not Send');
        }

    }

    public function requested_loan(){
        return view('manager.loan.requested',['data'=>LoanApprovel::all()]);
    }

    public function schedule($id)
    {
        return view('manager.loan.schdule.manage_schdule',['data'=>LoanSchduleApprovel::where('loan_id',$id)->get(),'id'=>$id]);
    }
    public function delete($id){
        $laonApprovel = LoanApprovel::find($id);
        if($laonApprovel->delete()){
            return redirect()->back()->with('success','Request Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Request Not Deleted');
        }
    }

    public function payments($id)
    {
        return view('manager.loan.payment.manage',['data'=>LoanPaymentApprovel::where('loan_id',$id)->get(),'id'=>$id]);
    }
}
