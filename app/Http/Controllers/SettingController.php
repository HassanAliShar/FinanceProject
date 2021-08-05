<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $logo = Setting::find(1);
        $site_name = Setting::find(2);
        $welcome = Setting::find(3);
        $footer = Setting::find(4);
        // dd($logo);
        return view('director.setting.site',compact('logo','site_name','welcome','footer'));
    }

    public function update_logo(Request $request, $id){
        request()->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       if ($files = $request->file('logo')) {
        // Define upload path
           $logoPath = public_path('/img/'); // upload path
        // Upload Orginal Image
           $logoImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($logoPath, $logoImage);

           $insert['image'] = "$logoImage";
        // Save In Database
            $imagemodel= Setting::find($id);
            $imagemodel->value="$logoImage";
            if($imagemodel->save()){
                return redirect()->back()->with('success','Logo Updated Successfully');
            }
       }
       else{
           return redirect()->back()->with('error','Please Select Logo');
       }
    }

    public function update_name(Request $request,$id){
        $name = Setting::find($id);
        $name->value = $request->site_name;
        if($name->save()){
            return redirect()->back()->with('success','Name Changed Successfully');
        }
        else{
            return redirect()->back()-with('error',"Name Not Changed");
        }
    }

    public function update_description(Request $request,$id){
        $description = Setting::find($id);
        $description->value = $request->description;

        if($description->save()){
            return redirect("/admin/site-setting")->with('success','Description Chagned Successfully');
        }
        else{
            return redirect()->back()-with('error','Description Not Chnaged');
        }
    }

    public function change_message(Request $request,$id){
        $message = Setting::find($id);
        $message->value = $request->site_message;
        if($message->save()){
            return redirect()->back()->with('success',"Message Change Successfully");
        }
        else{
            return redirect()->back()->with('error','Message Not Chagne');
        }
    }
    public function chagne_footer(Request $request,$id){
        $footer = Setting::find($id);
        $footer->value = $request->site_footer;
        if($footer->save()){
            return redirect()->back()->with('success',"Footer Change Successfully");
        }
        else{
            return redirect()->back()->with('error','Footer Not Change');
        }
    }
}
