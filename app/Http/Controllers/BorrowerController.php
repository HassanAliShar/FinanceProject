<?php

namespace App\Http\Controllers;

use App\Imports\BorrowerImport;
use App\Models\Borrower;
use Illuminate\Support\Str;
use App\Models\BorrowerFile;
use Illuminate\Http\Request;
use App\Models\BorrowerField;
use App\Models\BorrowerApproval;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BorrowerController extends Controller
{
    //Borrower Function for Director
    public function add_borrower(){
        return view('director.Borrower.add');
    }
    public function store_borrower(Request $request){
        DB::beginTransaction();
        $borrower = new Borrower();
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
        $borrower->created_by = Auth::user()->id;
        $borrower->status = 'Approved';
        if($borrower->save()){
            if($request->field_name != null){
                for($i = 0; $i<count($request->field_name); $i++){
                    $fields = new BorrowerField();
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
                    $fields = new BorrowerFile();
                    $fields->name = $request->file_name[$i];
                    $fileName[$i] = Str::random(30).'.'.$request->file_value[$i]->extension();
                    $request->file_value[$i]->move(public_path('BorrowerFiles'), $fileName[$i]);
                    $fields->value = $fileName[$i];
                    if(!$borrower->files()->save($fields)){
                        DB::rollback();
                        return redirect()->back()->with('error','Borrower File Not Added');
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success','Borrower Added Successfully');
        }
        else{
            DB::rollback();
            return redirect()->back()->with('error','Borrower Not Added');
        }
    }

    public function manage_borrower(){
        return view('director.Borrower.manage',['data'=> Borrower::all()]);
    }

    public function edit_borrower($id){
        return view('director.Borrower.edit',['data'=>Borrower::with('fields')->with('files')->find($id)]);
    }

    public function delete_borrower($id){
        $borrower = Borrower::find($id);

        if($borrower->delete()){
            return redirect()->back()->with('success','Borrower deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Borrower not deleted');
        }
    }
    public function update_borrower(Request $request,$id){
        DB::beginTransaction();
        $borrower = Borrower::find($id);
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
        $borrower->status = 'active';
        if($borrower->save()){
            $borrower->fields->each(function($field) {
                $field->delete();
            });

            if($request->field_name != null){
                for($i = 0; $i<count($request->field_name); $i++){
                    $fields = new BorrowerField();
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
            //     for($v = 0; $v<count($request->file_name); $v++){
            //         echo $request->file_value;
            //         $files = new BorrowerFile();
            //         $files->name = $request->file_name[$v];
            //         $fileName[$v] = Str::random(30).'.'.$request->file_value[$v]->extension();
            //         $request->file_value[$v]->move(public_path('BorrowerFiles'), $fileName[$v]);
            //         $files->value = $fileName[$v];
            //         if(!$borrower->files()->save($files)){
            //             DB::rollback();
            //             return redirect()->back()->with('error','Borrower File Not Updated');
            //         }
            //     }
            // }
            DB::commit();
            return redirect('/borrower/manage')->with('success','Borrower Updated Successfully');
        }
        else{
            DB::rollback();
            return redirect()->back()->with('error','Borrower Not Updated');
        }
    }

    public function view_borrower($id){
        return view('director.Borrower.view',['data'=>Borrower::find($id)]);
    }

    public function requested_borrower(){
        return view('director.Borrower.index',['data'=>BorrowerApproval::where('status','Pending')->get()]);
    }

    public function accept_borrower($id){
        DB::beginTransaction();
        $approvel = BorrowerApproval::with('fields')->with('files')->find($id);

        // dd($approvel)
        if($approvel->type =="Insert"){
            $borrower = new Borrower();
            $borrower->name = $approvel->name;
            $borrower->identity_no = $approvel->identity_no;
            $borrower->identity_type = $approvel->identity_type;
            $borrower->nationality = $approvel->nationality;
            $borrower->dob = $approvel->dob;
            $borrower->tax_identity_no = $approvel->tax_identity_no;
            $borrower->borrower_type = $approvel->borrower_type;
            $borrower->person_in_contact = $approvel->person_in_contact;
            $borrower->reference = $approvel->reference;
            $borrower->identity_address = $approvel->identity_address;
            $borrower->domicile_address = $approvel->domicile_address;
            $borrower->office_address = $approvel->office_address;
            $borrower->occupation = $approvel->occupation;
            $borrower->line_of_business = $approvel->line_of_business;
            $borrower->bank_account = $approvel->bank_account;
            $borrower->created_by = $approvel->user_id;
            $borrower->status = 'active';
            if($borrower->save()){
                if($approvel->fields != null){
                    foreach($approvel->fields as $row){
                        $fields = new BorrowerField();
                        $fields->name = $row->name;
                        $fields->value = $row->value;
                        if(!$borrower->fields()->save($fields)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Added');
                        }
                    }
                }
                if($approvel->files != null){
                    foreach($approvel->files as $file_row){
                        $files = new BorrowerFile();
                        $files->name = $file_row->name;
                        $files->value = $file_row->value;
                        if(!$borrower->files()->save($files)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Added');
                        }
                    }
                }
                $approvel->status = 'Approved';
                $approvel->save();
                DB::commit();
                return redirect()->back()->with('success','Borrower Added Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Borrower Not Added');
            }

        }
        else if($approvel->type =="Update"){
            $borrower = Borrower::find($approvel->borrower_id);
            $borrower->name = $approvel->name;
            $borrower->identity_no = $approvel->identity_no;
            $borrower->identity_type = $approvel->identity_type;
            $borrower->nationality = $approvel->nationality;
            $borrower->dob = $approvel->dob;
            $borrower->tax_identity_no = $approvel->tax_identity_no;
            $borrower->borrower_type = $approvel->borrower_type;
            $borrower->person_in_contact = $approvel->person_in_contact;
            $borrower->reference = $approvel->reference;
            $borrower->identity_address = $approvel->identity_address;
            $borrower->domicile_address = $approvel->domicile_address;
            $borrower->office_address = $approvel->office_address;
            $borrower->occupation = $approvel->occupation;
            $borrower->line_of_business = $approvel->line_of_business;
            $borrower->bank_account = $approvel->bank_account;
            $borrower->created_by = $approvel->user_id;
            $borrower->status = 'active';
            if($borrower->save()){
                $borrower->fields->each(function($field) {
                    $field->delete();
                });

                if($approvel->fields != null){
                    foreach($approvel->fields as $row){
                        $fields = new BorrowerField();
                        $fields->name = $row->name;
                        $fields->value = $row->value;
                        if(!$borrower->fields()->save($fields)){
                            DB::rollback();
                            return redirect()->back()->with('error','Borrower Not Updated');
                        }
                    }
                }
                $approvel->status = 'Approved';
                $approvel->save();
                DB::commit();
                return redirect()->back()->with('success','Borrower Updated Successfully');
            }
            else{
                DB::rollBack();
                return redirect()->back()->with('error','Borrower Not Updated');
            }
        }
        else{
            $borrower = Borrower::find($approvel->borrower_id);
            if($borrower->delete()){
                $approvel->status = 'Approved';
                $approvel->save();
                return redirect()->back()->with('success','Borrower Deleted Successfully');
            }
            else{
                return redirect()->back()->with('error','Borrower Not Deleted');
            }
        }

    }

    public function reject_borrower($id){
        $approvel = BorrowerApproval::find($id);
        $approvel->status = 'Rejected';
        if($approvel->save()){
            return redirect()->back()->with('success', $approvel->type.' Rejected');
        }
    }

    public function staff_borrower(){
        return view('staff.borrowers',['data'=>Borrower::all()]);
    }
    public function staff_view_borrower($id){
        return view('staff.view_borrowers',['data'=>Borrower::find($id)]);
    }

    public function import_borrower(Request $request){
        try {

            Excel::import(new BorrowerImport(Auth::user()->id), $request->excel_file);
            return redirect()->back()->with('success','Borrowers Imported Successfully');

        } catch (Exception $ex) {
            return redirect()->back()->with('error',$ex->getMessage());
        }


    }

}