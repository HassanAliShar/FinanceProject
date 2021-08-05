<?php

namespace App\Http\Controllers;

use Exception;
use Mockery\Expectation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function index(){
        $filesName = File::files(storage_path().'/app/backup/');
        $arr = [];
        foreach ($filesName as $file) {
            $ex = explode("/"  , $file);
            array_push($arr , $ex[count($ex) - 1]);
        }
        return view('director.db_backup.backup',compact('arr'));
    }

    public function get_db(){
        try{
            Artisan::call('database:backup');



            return redirect()->back()->with('success','Backup Created Successfully');



        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    public function removebackup($filesName)
    {
        if(File::exists(storage_path().'/app/backup/'.$filesName)){
            File::delete(storage_path().'/app/backup/'.$filesName);
            return redirect()->back()->with('success','File Deleted Successfully');
        }else{
          return redirect()->back()->with('error','File Not Deleted');
        }

    }
}
