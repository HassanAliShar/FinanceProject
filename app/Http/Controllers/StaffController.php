<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function add_staff(){
        return view('director.staff.add');
    }

    public function store_staff(Request $request){
        $staff = new User();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->role_id = getStaffRoleId();
        if($staff->save()){
            return redirect()->back()->with('success','Staff Member Created');
        }
        else{
            return redirect()->back()->with('error','Memeber Not Created');
        }
    }

    public function manage_staff(){

        return view('director.staff.manage',['data' => User::where('role_id',getStaffRoleId())->get()]);
    }

    public function edit_staff($id){
        return view('director.staff.edit',['data'=>User::find($id),'role'=>Role::all()]);
    }

    public function update_staff(Request $request,$id){
        $staff = User::find($id);
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->role_id = $request->role_id;
        if($staff->save()){
            return redirect('/staff/manage')->with('success','Staff Member Updated');
        }
        else{
            return redirect()->back()->with('error','Memeber Not Updated');
        }
    }

    public function delete_staff($id){
        $user = User::find($id);
        if($user->delete()){
            return redirect()->back()->with('success','Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Some thing went wrong');
        }
    }

    // Managers Section Start Here
    public function add_manager(){
        return view('director.manager.add');
    }

    public function store_manager(Request $request){
        $staff = new User();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->role_id = getManagerRoleId();
        if($staff->save()){
            return redirect()->back()->with('success','Manager Member Created');
        }
        else{
            return redirect()->back()->with('error','Manager Not Created');
        }
    }

    public function manage_manager(){

        return view('director.manager.manage',['data' => User::where('role_id',getManagerRoleId())->get()]);
    }

    public function edit_manager($id){
        return view('director.manager.edit',['data'=>User::find($id),'role'=>Role::all()]);
    }

    public function update_manager(Request $request,$id){
        $staff = User::find($id);
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->role_id = $request->role_id;
        if($staff->save()){
            return redirect('/manager/manage')->with('success','Manager Member Updated');
        }
        else{
            return redirect()->back()->with('error','Manager Not Updated');
        }
    }

    public function delete_manager($id){
        $user = User::find($id);
        if($user->delete()){
            return redirect()->back()->with('success','Deleted Successfully');
        }
        else{
            return redirect()->back()->with('error','Some thing went wrong');
        }
    }
}
