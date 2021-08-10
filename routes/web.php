<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Imports\UsersImport;
use App\Models\LoanSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register'=>false]);

Route::get('/home', "HomeController@index")->name('home');



Route::middleware(['auth'])->group(function () {
    Route::middleware(['director'])->group(function(){
        Route::get('/admin_dashboard',function(){
            $today = Carbon::now();
            return view('director.dashboard',['data'=>LoanSchedule::all(),'late_payment'=>LoanSchedule::where('expected_payment_date','<',$today)->get()]);
        })->name('admin.dashboard');
        Route::post('/import_user','LoanController@import_user')->name('import.user');
        // directore routes for staff
        Route::prefix('staff')->group(function () {
            Route::get('/add', 'StaffController@add_staff')->name('add.staff');
            Route::get('/manage','StaffController@manage_staff')->name('manage.staff');
            Route::post('/store_staff','StaffController@store_staff')->name('store_staff');
            Route::get('/edit/{id}', 'StaffController@edit_staff')->name('edit.staff');
            Route::post('/update/{id}','StaffController@update_staff')->name('update.staff');
            Route::get('delete/{id}','StaffController@delete_staff')->name('delete.staff');
        });
        //director routes for Borrwoers
        Route::prefix('borrower')->group(function(){
            Route::get('/add', 'BorrowerController@add_borrower')->name('add.borrower');
            Route::post('/create', 'BorrowerController@store_borrower')->name('store_borrower');
            Route::get('/manage','BorrowerController@manage_borrower')->name('manage.borrower');
            Route::get('/edit/{id}', 'BorrowerController@edit_borrower')->name('edit.borrower');
            Route::get('/view/{id}', 'BorrowerController@view_borrower')->name('view.borrower');
            Route::get('/delete/{id}', 'BorrowerController@delete_borrower')->name('delete.borrower');
            Route::post('/update/{id}', 'BorrowerController@update_borrower')->name('update.borrower');
            Route::get('/requested','BorrowerController@requested_borrower')->name('requested.borrower');
            Route::get('/accept/{id}','BorrowerController@accept_borrower')->name('accept.borrower');
            Route::get('/reject/{id}', 'BorrowerController@reject_borrower')->name('reject.borrower');
            Route::post('/import', 'BorrowerController@import_borrower')->name('import.borrower');
            Route::get('/export', 'BorrowerController@export_borrower')->name('export.borrower');
            Route::get('/view_requested/{id}','BorrowerController@view_requested_borrower')->name('view_requested.borrower');
        });

        // director routes for managers
        Route::prefix('manager')->group(function () {
            Route::get('/add', 'StaffController@add_manager')->name('add.manager');
            Route::get('/manage','StaffController@manage_manager')->name('manage.manager');
            Route::post('/store','StaffController@store_manager')->name('store.manager');
            Route::get('/edit/{id}', 'StaffController@edit_manager')->name('edit.manager');
            Route::post('/update/{id}','StaffController@update_manager')->name('update.manager');
            Route::get('delete/{id}','StaffController@delete_manager')->name('delete.manager');
        });

        // director route of Loan
        Route::prefix('loan')->group(function(){
            Route::get('/add', 'LoanController@create')->name('add.loan');
            Route::post('/create','LoanController@store')->name('store.loan');
            Route::get('/manage', 'LoanController@index')->name('manage.loan');
            Route::get('/delete/{id}','LoanController@destroy')->name('delete.loan');
            Route::get('/edit/{id}', 'LoanController@edit')->name('edit.loan');
            Route::post('/update/{id}','LoanController@update')->name('update.loan');
            Route::get('/show/{id}','LoanController@show_view')->name('show.loan');
            Route::get('/requested_loan','LoanController@requested_loan')->name('requested.loan');
            Route::get('/approve_loan/{id}','LoanController@approve_loan')->name('approve.loan');
            Route::get('/reject_loan/{id}','LoanController@reject_loan')->name('reject.loan');
            Route::post('/import_loan','LoanController@import_loan')->name('import.loan');
            Route::get('/export_loan', 'LoanController@export_loan')->name('export.loan');
            Route::get('/view_requested/{id}','LoanController@view_requested_loan')->name('view_requested.loan');

            Route::get('/schedule/{loan}', 'LoanController@schedule')->name('manage.schedule');
            Route::get('/add-schdule/{loan}','LaonScheduleController@create')->name('add.schdule');
            Route::post('/store-schdule/{id}', 'LaonScheduleController@store')->name('store.schdule');
            Route::get('/delete-schdule/{id}','LaonScheduleController@destory')->name('delete.schdule');
            Route::get('/edit-schdule/{id}','LaonScheduleController@edit')->name('edit.schdul');
            Route::post('/update-schdule/{id}','LaonScheduleController@update')->name('update.schdule');
            Route::get('/show-schdule/{id}','LaonScheduleController@show')->name('show.schdule');
            Route::get('/requested','LaonScheduleController@requested_schdule')->name('requested.schdule');
            Route::get('/approve/{id}','LaonScheduleController@approve_schdule')->name('approve.schdule');
            Route::get('/reject/{id}','LaonScheduleController@reject_schdule')->name('reject.schdule');
            Route::post('/import_schdule','LaonScheduleController@import_schdule')->name('import.schdule');
            Route::get('/paid/{id}','LaonScheduleController@schdule_paid')->name('paid.schdule');
            Route::get('/export_schdule','LaonScheduleController@export_schdule')->name('export.schdule');
         });

         // director route of laon payments
         Route::prefix('payment')->group(function(){
            Route::get('/manage/{loan}', 'LoanController@payments')->name('manage.payment');
            Route::get('/add-payment/{loan}','LaonPaymentController@create')->name('add.payment');
            Route::post('/store/{id}', 'LaonPaymentController@store')->name('store.payment');
            Route::get('/delete/{id}','LaonPaymentController@destory')->name('delete.payment');
            Route::get('/edit/{id}','LaonPaymentController@edit')->name('edit.payment');
            Route::post('/update/{id}','LaonPaymentController@update')->name('update.payment');
            Route::get('/show/{id}','LaonPaymentController@show')->name('show.payment');
            Route::get('/requested','LaonPaymentController@requested_payment')->name('requested.payment');
            Route::get('/approve/{id}','LaonPaymentController@approve_request')->name('approve.payment');
            Route::get('/reject/{id}','LaonPaymentController@reject_request')->name('reject.payment');
            Route::post('/import','LaonPaymentController@import_payment')->name('import.payment');
            Route::get('/export', 'LaonPaymentController@export_payment')->name('export.payment');

         });

         Route::prefix('site')->group(function(){
             Route::get('/settings','SettingController@index')->name('setting.page');
             Route::post('/update_logo/{id}','SettingController@update_logo')->name('setting.update.logo');
             Route::post('/update_name/{id}', 'SettingController@update_name')->name('setting.update.name');
             Route::put('/update_message/{id}', 'SettingController@change_message')->name('setting.update.message');
             Route::put('/update_footer/{id}', 'SettingController@chagne_footer')->name('setting.update.footer');
         });
         Route::prefix('backup')->group(function(){
             Route::get('/get_db','BackupController@index')->name('setting.db.backup');
             Route::post('/create_backup','BackupController@get_db')->name('create.db.backup');
            //  Route::get('/files','BackupController@all_files')->name('get_files');

            Route::get('files/{file_name}', function($file_name = null)
            {
                $path = storage_path().'/'.'app'.'/backup/'.$file_name;
                if (file_exists($path)) {
                    return Response::download($path);
                }
            })->name("db.download");
            Route::get('/delete/{file_name}','BackupController@removebackup')->name('db.file.delete');
         });



    });

    // Routes For Managers
    Route::middleware(['managers'])->group(function () {
        Route::prefix('borrw')->group(function () {
            Route::get('/add', 'BorrowerApprovelController@add_borrower_approve')->name('add.b.approve');
            Route::get('/manage','BorrowerApprovelController@manage_borrower_approve')->name('manage.b.approve');
            Route::post('/store','BorrowerApprovelController@store_borrower_approve')->name('store.b.approve');
            Route::get('/edit/{id}', 'BorrowerApprovelController@edit_borrower_approve')->name('edit.b.approve');
            Route::get('/view/{id}', 'BorrowerApprovelController@view_borrower_approve')->name('view.b.approve');
            Route::post('/update/{id}','BorrowerApprovelController@update_borrower_approve')->name('update.b.approve');
            Route::get('/delete/{id}','BorrowerApprovelController@delete_borrower_approve')->name('delete.b.approve');
            Route::get('/requested','BorrowerApprovelController@requested_borrower_approve')->name('requested.b.approve');
            Route::get('/delete_requested/{id}','BorrowerApprovelController@delete_requested')->name('delete.requested.b.approve');
            Route::get('/view_requested/{id}', 'BorrowerApprovelController@view_requested_borrower')->name('view_requested.b.approve');
        });
        Route::prefix('mg-loan')->group(function(){
            Route::get('/add', 'LoanApprovelController@create')->name('add.mg.loan');
            Route::post('/create','LoanApprovelController@store')->name('store.mg.loan');
            Route::get('/manage', 'LoanApprovelController@index')->name('manage.mg.loan');
            Route::get('/delete/{id}','LoanApprovelController@destroy')->name('delete.mg.loan');
            Route::get('/edit/{id}', 'LoanApprovelController@edit')->name('edit.mg.loan');
            Route::post('/update/{id}','LoanApprovelController@update')->name('update.mg.loan');
            Route::get('/show/{id}','LoanApprovelController@show_view')->name('show.mg.loan');
            Route::get('/requested','LoanApprovelController@requested_loan')->name('requested.mg.loan');
            Route::get('delete_req/{id}','LoanApprovelController@delete')->name('delete_req.mg.loan');
            Route::get('/view_requested/{id}','LoanApprovelController@view_requested')->name('view_requested.mg.loan');
        });

        Route::prefix('mg-schdule')->group(function (){
            Route::get('/schedule/{loan}', 'LoanSchduleApprovelController@schedule')->name('manage.mg.schdule');
            Route::get('/add-schdule/{loan}','LoanSchduleApprovelController@create')->name('add.mg.schdule');
            Route::post('/store-schdule/{id}', 'LoanSchduleApprovelController@store')->name('store.mg.schdule');
            Route::get('/delete-schdule/{id}','LoanSchduleApprovelController@destory')->name('delete.mg.schdule');
            Route::get('/edit-schdule/{id}','LoanSchduleApprovelController@edit')->name('edit.mg.schdul');
            Route::post('/update-schdule/{id}','LoanSchduleApprovelController@update')->name('update.mg.schdule');
            Route::get('/show-schdule/{id}','LoanSchduleApprovelController@show')->name('show.mg.schdule');
            Route::get('/requested','LoanSchduleApprovelController@requested_schdule')->name('requested.mg.schdule');
            Route::get('/view_requested/{id}','LoanSchduleApprovelController@view_schdule')->name('view_requested.mg.schdule');
            Route::get('/delete_req/{id}','LoanSchduleApprovelController@delete_schdule')->name('delete_requested.mg.schdule');

        });

        Route::prefix('mg-payment')->group(function(){
            Route::get('/manage/{loan}', 'LoanPaymentApprovelController@payments')->name('manage.mg.payment');
            Route::get('/add-payment/{loan}','LoanPaymentApprovelController@create')->name('add.mg.payment');
            Route::post('/store/{id}', 'LoanPaymentApprovelController@store')->name('store.mg.payment');
            Route::get('/delete/{id}','LoanPaymentApprovelController@destory')->name('delete.mg.payment');
            Route::get('/edit/{id}','LoanPaymentApprovelController@edit')->name('edit.mg.payment');
            Route::post('/update/{id}','LoanPaymentApprovelController@update')->name('update.mg.payment');
            Route::get('/show/{id}','LoanPaymentApprovelController@show')->name('show.mg.payment');
            Route::get('/requested','LoanPaymentApprovelController@index')->name('request.mg.payment');
            Route::get('/delete/request/{id}','LoanPaymentApprovelController@delete_req')->name('delete_req.mg.payment');
            Route::get('/request_view/{id}','LoanPaymentApprovelController@show_view')->name('requested_view.mg.payment');
         });

    });
    Route::middleware('staffs')->group(function(){
        Route::get('/staff_borrower', 'BorrowerController@staff_borrower')->name('staff.borrower');
        Route::get('/borrower/{id}', 'BorrowerController@staff_view_borrower')->name('staff.view.borrower');
        Route::prefix('staff-loan')->group(function (){
            Route::get('/manage','LoanController@staff_manage')->name('staff.loan.manage');
            Route::get('/view/{id}','LoanController@staff_viwe')->name('staff.loan.view');
        });
        Route::prefix('staff-schdule')->group(function (){
            Route::get('/manage/{id}','LaonScheduleController@staff_manage')->name('staff.schdule.manage');
            Route::get('/view/{id}','LaonScheduleController@staff_viwe')->name('staff.schdule.view');
        });
        Route::prefix('staff-payment')->group(function(){
            Route::get('/manage','LaonPaymentController@staff_manage')->name('staff.payment.manage');
            Route::get('/view/{id}','LaonPaymentController@staff_viwe')->name('staff.payment.view');
        });
    });
});
