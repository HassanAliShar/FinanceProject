<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Borrower;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BorrowerApproval;
use Illuminate\Support\Facades\DB;
use App\Models\BorrowerFileApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\BorrowerFieldApproval;

class BorrowerApprovelController extends Controller
{
    //Borrower Function for Director
    public function add_borrower_approve(){
        return view('manager.Borrower.add');
    }
    public function store_borrower_approve(Request $request){
        DB::beginTransaction();
        $borrower = new BorrowerApproval();
        $borrower->name = $request->name;
        $borrower->identity_no = $request->identity_no;
        $borrower->identity_type = $request->identity_type;
        $borrower->nationality = $request->nationality;
        $borrower->dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $borrower->tax_identity_no = $request->tax_identity_no;
        $borrower->borrower_type = $request->borrower_type;
        $borrower->person_in_contact = $request->person_in_contact;
        $borrower->reference = $request->reference;
        $borrower->identity_address = $request->identity_address;
        $borrower->domicile_address = $request->domicile_address;
        $borrower->office_address = $request->office_address;
        $borrower->occupation = $request->occupation;
        $borrower->line_of_business = $request->line_of_business;
        $borrower->bank_account = $request->bank_account;
        $borrower->internal_number = $request->internal_number;
        $borrower->place_of_birth = $request->place_of_birth;
        $borrower->last_education = $request->last_education;
        $borrower->mother_maiden = $request->mother_maiden;
        $borrower->surveyor = $request->surveyor;
        $borrower->partner_spouse = $request->partner_spouse;
        $borrower->partner_spouse_identity_number = $request->partner_spouse_identity_number;
        $borrower->partner_spouse_contact_number = $request->partner_spouse_contact_number;
        $borrower->partner_spouse_domicile_address = $request->partner_spouse_domicile_address;
        $borrower->marriage_status = $request->marriage_status;
        $borrower->family_card_number = $request->family_card_number;
        $borrower->home_number = $request->home_number;
        $borrower->mobile_number = $request->mobile_number;
        $borrower->office_number = $request->office_number;
        $borrower->domicile_status = $request->domicile_status;
        $borrower->email = $request->email;
        $borrower->identity_address = $request->identity_address;
        $borrower->domicile_address = $request->domicile_address;
        $borrower->office_address = $request->office_address;
        $borrower->line_of_business = $request->line_of_business;
        $borrower->business_experience = $request->business_experience;
        $borrower->business_capital = $request->business_capital;
        $borrower->annual_income = $request->annual_income;
        $borrower->other_income = $request->other_income;
        $borrower->joint_income = $request->joint_income;
        $borrower->total_income = $request->total_income;
        $borrower->living_expenses = $request->living_expenses;
        $borrower->business_expenses = $request->business_expenses;
        $borrower->other_expenses = $request->other_expenses;
        $borrower->other_loan = $request->other_loan;
        $borrower->net_cash_flow = $request->net_cash_flow;
        $borrower->total_assets = $request->total_assets;
        $borrower->other_lenders = $request->other_lenders;
        $borrower->type = 'Insert';
        $borrower->user_id = Auth::user()->id;
        $borrower->status = 'Pending';
        if($borrower->save()){
            if($request->field_name != null){
                for($i = 0; $i<count($request->field_name); $i++){
                    $fields = new BorrowerFieldApproval();
                    $fields->name = $request->field_name[$i];
                    $fields->value = $request->field_value[$i];
                    if(!$borrower->fields()->save($fields)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower Not Added');
                    }
                }
            }
            if($request->file_name != null){
                for($i = 0; $i<count($request->file_name); $i++){
                    $files = new BorrowerFileApproval();
                    $files->name = $request->file_name[$i];
                    $fileName[$i] = Str::random(30).'.'.$request->file_value[$i]->extension();
                    $request->file_value[$i]->move(public_path('BorrowerFiles'), $fileName[$i]);
                    $files->value = $fileName[$i];
                    if(!$borrower->files()->save($files)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower File Not Added');
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success','Request Send For Add Borrower');
        }
        else{
            DB::rollback();
            return redirect()->back()->with('error','Request Not Sent');
        }
    }

    public function manage_borrower_approve(){
        return view('manager.Borrower.manage',['data'=> Borrower::all()]);
    }

    public function edit_borrower_approve($id){
        return view('manager.Borrower.edit',['data'=>Borrower::find($id)]);
    }

    public function delete_borrower_approve($id){
        $get_data = Borrower::find($id);
        $borrower = new BorrowerApproval();
        $borrower->borrower_id = $id;
        $borrower->name = $get_data->name;
        $borrower->identity_no = $get_data->identity_no;
        $borrower->identity_type = $get_data->identity_type;
        $borrower->nationality = $get_data->nationality;
        $borrower->dob = Carbon::createFromFormat('d/m/Y', $get_data->dob)->format('Y-m-d');
        $borrower->tax_identity_no = $get_data->tax_identity_no;
        $borrower->borrower_type = $get_data->borrower_type;
        $borrower->person_in_contact = $get_data->person_in_contact;
        $borrower->reference = $get_data->reference;
        $borrower->identity_address = $get_data->identity_address;
        $borrower->domicile_address = $get_data->domicile_address;
        $borrower->office_address = $get_data->office_address;
        $borrower->occupation = $get_data->occupation;
        $borrower->line_of_business = $get_data->line_of_business;
        $borrower->bank_account = $get_data->bank_account;
        $borrower->internal_number = $get_data->internal_number;
        $borrower->place_of_birth = $get_data->place_of_birth;
        $borrower->last_education = $get_data->last_education;
        $borrower->mother_maiden = $get_data->mother_maiden;
        $borrower->surveyor = $get_data->surveyor;
        $borrower->partner_spouse = $get_data->partner_spouse;
        $borrower->partner_spouse_identity_number = $get_data->partner_spouse_identity_number;
        $borrower->partner_spouse_contact_number = $get_data->partner_spouse_contact_number;
        $borrower->partner_spouse_domicile_address = $get_data->partner_spouse_domicile_address;
        $borrower->marriage_status = $get_data->marriage_status;
        $borrower->family_card_number = $get_data->family_card_number;
        $borrower->home_number = $get_data->home_number;
        $borrower->mobile_number = $get_data->mobile_number;
        $borrower->office_number = $get_data->office_number;
        $borrower->domicile_status = $get_data->domicile_status;
        $borrower->email = $get_data->email;
        $borrower->identity_address = $get_data->identity_address;
        $borrower->domicile_address = $get_data->domicile_address;
        $borrower->office_address = $get_data->office_address;
        $borrower->line_of_business = $get_data->line_of_business;
        $borrower->business_experience = $get_data->business_experience;
        $borrower->business_capital = $get_data->business_capital;
        $borrower->annual_income = $get_data->annual_income;
        $borrower->other_income = $get_data->other_income;
        $borrower->joint_income = $get_data->joint_income;
        $borrower->total_income = $get_data->total_income;
        $borrower->living_expenses = $get_data->living_expenses;
        $borrower->business_expenses = $get_data->business_expenses;
        $borrower->other_expenses = $get_data->other_expenses;
        $borrower->other_loan = $get_data->other_loan;
        $borrower->net_cash_flow = $get_data->net_cash_flow;
        $borrower->total_assets = $get_data->total_assets;
        $borrower->other_lenders = $get_data->other_lenders;
        $borrower->type = 'Delete';
        $borrower->user_id = Auth::user()->id;
        $borrower->status = 'Pending';
        if($borrower->save()){
            return redirect()->back()->with('success','Request send for Delete');
        }
        else{
            return redirect()->back()->with('error','Request Not Send');
        }
    }
    public function update_borrower_approve(Request $request,$id){
        // return $request;
        DB::beginTransaction();
        $borrower = new BorrowerApproval();
        $borrower->borrower_id = $id;
        $borrower->name = $request->name;
        $borrower->identity_no = $request->identity_no;
        $borrower->identity_type = $request->identity_type;
        $borrower->nationality = $request->nationality;
        $borrower->dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $borrower->tax_identity_no = $request->tax_identity_no;
        $borrower->borrower_type = $request->borrower_type;
        $borrower->person_in_contact = $request->person_in_contact;
        $borrower->reference = $request->reference;
        $borrower->identity_address = $request->identity_address;
        $borrower->domicile_address = $request->domicile_address;
        $borrower->office_address = $request->office_address;
        $borrower->occupation = $request->occupation;
        $borrower->line_of_business = $request->line_of_business;
        $borrower->bank_account = $request->bank_account;
        $borrower->internal_number = $request->internal_number;
        $borrower->place_of_birth = $request->place_of_birth;
        $borrower->last_education = $request->last_education;
        $borrower->mother_maiden = $request->mother_maiden;
        $borrower->surveyor = $request->surveyor;
        $borrower->partner_spouse = $request->partner_spouse;
        $borrower->partner_spouse_identity_number = $request->partner_spouse_identity_number;
        $borrower->partner_spouse_contact_number = $request->partner_spouse_contact_number;
        $borrower->partner_spouse_domicile_address = $request->partner_spouse_domicile_address;
        $borrower->marriage_status = $request->marriage_status;
        $borrower->family_card_number = $request->family_card_number;
        $borrower->home_number = $request->home_number;
        $borrower->mobile_number = $request->mobile_number;
        $borrower->office_number = $request->office_number;
        $borrower->domicile_status = $request->domicile_status;
        $borrower->email = $request->email;
        $borrower->identity_address = $request->identity_address;
        $borrower->domicile_address = $request->domicile_address;
        $borrower->office_address = $request->office_address;
        $borrower->line_of_business = $request->line_of_business;
        $borrower->business_experience = $request->business_experience;
        $borrower->business_capital = $request->business_capital;
        $borrower->annual_income = $request->annual_income;
        $borrower->other_income = $request->other_income;
        $borrower->joint_income = $request->joint_income;
        $borrower->total_income = $request->total_income;
        $borrower->living_expenses = $request->living_expenses;
        $borrower->business_expenses = $request->business_expenses;
        $borrower->other_expenses = $request->other_expenses;
        $borrower->other_loan = $request->other_loan;
        $borrower->net_cash_flow = $request->net_cash_flow;
        $borrower->total_assets = $request->total_assets;
        $borrower->other_lenders = $request->other_lenders;
        $borrower->type = 'Update';
        $borrower->user_id = Auth::user()->id;
        $borrower->status = 'Pending';
        if($borrower->save()){
            $borrower->fields->each(function($field) {
                $field->delete();
            });
            if($request->field_name != null){
                for($i = 0; $i<count($request->field_name); $i++){
                    $fields = new BorrowerFieldApproval();
                    $fields->name = $request->field_name[$i];
                    $fields->value = $request->field_value[$i];
                    if(!$borrower->fields()->save($fields)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower Not Added');
                    }
                }
            }
            // $borrower->files->each(function($files) {
            //     $files->delete();
            // });
            // if($request->file_name != null){
            //     for($i = 0; $i<count($request->file_name); $i++){
            //         $files = new BorrowerFileApproval();
            //         $files->name = $request->file_name[$i];
            //         $files->value = $request->file_value[$i];
            //         if(!$borrower->files()->save($files)){
            //             DB::rollback();
            //             return redirect()->back()->with('error','Borrower Not Added');
            //         }
            //     }
            // }
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

                foreach ($request->file_status as $v => $value) {
                    $files = new BorrowerFileApproval();
                    $v = (int)$v;
                    $files->name = $request->file_name[$v];
                    if($request->file_status[$v] != "null"){
                        // return "kuch bhi";
                        $files->value = $request->file_status[$v];
                    }
                    else{

                        $fileName[$v] = Str::random(30).'.'.$request->file_value[$v]->extension();
                        $request->file_value[$v]->move(public_path('BorrowerFiles'), $fileName[$v]);
                        $files->value = $fileName[$v];
                    }
                    if(!$borrower->files()->save($files)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower File Not Updated');
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success','Request send for Update');
        }
        else{
            DB::rollback();
            return redirect()->back()->with('error','Request Not Send');
        }
    }

    public function view_borrower_approve($id){
        return view('manager.Borrower.view',['data'=>Borrower::find($id)]);
    }
    public function view_requested_borrower($id){
        return view('manager.Borrower.view_requtested_borrower',['data'=>BorrowerApproval::find($id)]);
    }
    public function requested_borrower_approve(){
        return view('manager.Borrower.index',['data'=>BorrowerApproval::where('status','Pending')->where('user_id',Auth::user()->id)->get()]);
    }
    public function delete_requested($id){
        $approvel = BorrowerApproval::find($id);

        if($approvel->delete()){
            return redirect()->back()->with('success','Request Borrower Deleted Successfully');
        }
        else{
            return redirect()->back()->with('success','Request Borrower Not Deleted');
        }
    }
}
