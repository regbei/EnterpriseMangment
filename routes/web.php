<?php

// use App\Models\User;
use App\Models\Payroll;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\CoAccountController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DepartmentController;

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
})->middleware('guest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        
        Route::controller(UserController::class)->group(function(){
            Route::get('/User', 'index')->name('User-info');
            Route::get('/User/create', 'create')->name('User-create');
            Route::post('/User/store', 'store');
            Route::get('/User/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/User/update/{id}', 'update')->where('id', '[0-9]+');
            Route::delete('/User/{id}/delete', 'delete')->where('id', '[0-9]+');
        });


        Route::controller(UserController::class)->group(function(){
    
            Route::get('/Notification/{id}/show', 'marked')->name('Notification-show');
        
    });


        Route::controller(EmployeeController::class)->group(function(){
            Route::get('/Employee', 'index')->name('employee-info');
            Route::get('/Employee/create', 'create')->name('employee-create');
            Route::post('/Employee/store', 'store')->name('employee-store');
            Route::get('/Employee/single/{id}', 'show')->where('id', '[0-9]+');
            Route::get('/Employee/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/Employee/{id}/update', 'update')->where('id', '[0-9]+');
            Route::delete('/Employee/{id}/delete', 'delete')->where('id', '[0-9]+');
        });


        Route::controller(DepartmentController::class)->group(function(){
            Route::get('/DPT', 'index')->name('DPT-info');
            Route::get('/DPT/create', 'create')->name('DPT-create');
            Route::post('/DPT/store', 'store');
            Route::get('/DPT/{id}/show', 'show')->where('id', '[0-9]+');
            Route::get('/DPT/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/DPT/{id}/update', 'update')->where('id', '[0-9]+');
            Route::delete('/DPT/{id}/delete', 'delete')->where('id', '[0-9]+');
        });


        Route::controller(CoAccountController::class)->group(function(){
            Route::get('/Account', 'index')->name('Account-info');
            Route::get('/Account/single/{id}', 'show')->name('Account-detail')->where('id', '[0-9]+');
            Route::get('/Account/reports', 'transaction_report')->name('Account-reports');
            Route::get('/Account/create', 'create');
            Route::post('/Account/store', 'store');
            Route::get('/Account/transaction', 'create_transaction')->name('Account-transaction');
            Route::post('/Account/transaction/store', 'transaction_store');
            Route::get('/Account/{id}/edit', 'edit');
            Route::put('/Account/{id}/update', 'update')->where('id', '[0-9]+');
            Route::delete('/Account/delete', 'delete')->where('id', '[0-9]+');

        });



        Route::controller(BankController::class)->group(function(){
            Route::get('/Bank', 'index')->name('Bank-info');
            Route::get('/Bank/reports', 'transaction_report')->name('Bank-reports');
            Route::get('/Bank/create', 'create')->name('Bank-create');
            Route::post('/Bank/store', 'store');
            Route::get('/Bank/transaction', 'create_transaction')->name('Bank-transaction');
            Route::post('/Bank/transaction/store', 'transaction_store');
            Route::get('/Bank/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/Bank/{id}/update', 'update')->where('id', '[0-9]+');
            Route::delete('/Bank/delete', 'delete')->where('id', '[0-9]+');

        });

        
        Route::controller(PayrollController::class)->group(function(){
            Route::get('/Payroll', 'index')->name('Payroll-info');
            Route::get('/Payroll/create', 'create')->name('Payroll-create');
            Route::get('/Payroll/transaction', 'transaction')->name('Payroll-transaction');
            Route::get('/Payroll/transaction/reports', 'transaction_report')->name('Payroll-reports');
            Route::post('/Payroll/transaction/save', 'save');
            Route::post('/Payroll/store', 'store');
            Route::get('/Payroll/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/Payroll/{id}/update', 'update')->where('id', '[0-9]+');
            Route::get('/Payroll/single/{id}', 'show')->where('id', '[0-9]+');
            Route::delete('/Payroll/{id}/delete', 'delete')->where('id', '[0-9]+');
        });

        Route::controller(AllowanceController::class)->group(function(){
            Route::get('/Allowance', 'index')->name('Allowance-info');
            Route::get('/Allowance/create', 'create')->name('Allowance-create');
            Route::get('/Allowance/transaction', 'transaction')->name('Allowance-transaction');
            Route::get('/Allowance/transaction/reports', 'transaction_report')->name('Allowance-reports');
            Route::post('/Allowance/transaction/save', 'save');
            Route::post('/Allowance/store', 'store');
            Route::get('/Allowance/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/Allowance/{id}/update', 'update')->where('id', '[0-9]+');
            Route::delete('/Allowance/delete', 'delete')->where('id', '[0-9]+');
            Route::delete('/Allowance/transaction/{id}/delete', 'transaction_delete')->where('id', '[0-9]+');
        });
   
   
        Route::controller(DeductionController::class)->group(function(){
            Route::get('/Deduction', 'index')->name('Deduction-info');
            Route::get('/Deduction/create', 'create')->name('Deduction-create');
            Route::get('/Deduction/transaction', 'transaction')->name('Deduction-transaction');
            Route::get('/Deduction/transaction/reports', 'transaction_report')->name('Deduction-reports');
            Route::post('/Deduction/transaction/save', 'save');
            Route::post('/Deduction/store', 'store');
            Route::get('/Deduction/{id}/edit', 'edit')->where('id', '[0-9]+');
            Route::put('/Deduction/{id}/update', 'update')->where('id', '[0-9]+');
            Route::delete('/Deduction/delete', 'delete')->where('id', '[0-9]+');
            Route::delete('/Deduction/transaction/{id}/delete', 'transaction_delete')->where('id', '[0-9]+');
        });

        // Route::controller(PaymentController::class)->group(function(){
        //     Route::get('/Payment/index', 'index');
        //     Route::get('/Payment/create', 'create');
        //     Route::post('/Payment/store', 'store');
        //     Route::get('/Payment/{id}/edit', 'edit')->where('id', '[0-9]+');
        //     Route::put('/Payment/{id}/update', 'update')->where('id', '[0-9]+');
        //     Route::delete('/Payment/{id}/delete', 'delete')->where('id', '[0-9]+');
        // });

