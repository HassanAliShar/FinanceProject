<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DirectorController extends Controller
{
    public function index(){
        return view('director.new_directors.manage',['data'=>User::where('role_id',1)->get()]);
    }

    public function add(){
        return view('director.new_directors.add');
    }

    public function edit($id){
        return view('director.new_directors.edit',['data'=>User::find($id),'role'=>Role::all()]);
    }

    public function delete($id){
        $director = User::find($id);
        if($director->delete()){
            return redirect()->back()->with('success','Deleted Successfully');
        }
    }

    public function store(Request $request){
        $director = new User();
        $director->name = $request->name;
        $director->email = $request->email;
        $director->password = Hash::make($request->password);
        $director->role_id = getDirectorRoleId();
        if($director->save()){
            return redirect()->back()->with('success','Direcotor Created Successfully');
        }
        else{
            return redirect()->back()->with('error','Director Not Created');
        }
    }
    public function update(Request $request, $id){
        $director = User::find($id);
        $director->name = $request->name;
        $director->email = $request->email;
        $director->role_id = $request->role_id;
        if($director->save()){
            return redirect('/dir/manage')->with('success','Director Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Director Not Updated');
        }
    }
}
