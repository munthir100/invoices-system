<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\InvoiceController;
use App\Http\Controllers\user\CustomerController;
use App\Http\Controllers\administrator\AuthController;
use App\Http\Controllers\administrator\SalespersonController;
use App\Http\Controllers\administrator\AdministratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AdministratorController::class, 'reports'])->name('dashboard');

    Route::name('administrator.')->group(function(){
        Route::resource('administrators', AdministratorController::class);
        Route::resource('salespersons', SalespersonController::class);
    });
    Route::name('user.')->group(function(){
        Route::resource('invoices', InvoiceController::class);
        Route::resource('customers', CustomerController::class);
    });
});
