<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Support\Str;
use App\Models\BorrowerApproval;
use App\Models\BorrowerFieldApproval;
use App\Models\BorrowerFileApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $borrower->dob = $request->dob;
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
        $borrower->dob = $get_data->dob;
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
        DB::beginTransaction();
        $borrower = new BorrowerApproval();
        $borrower->borrower_id = $id;
        $borrower->name = $request->name;
        $borrower->identity_no = $request->identity_no;
        $borrower->identity_type = $request->identity_type;
        $borrower->nationality = $request->nationality;
        $borrower->dob = $request->dob;
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
