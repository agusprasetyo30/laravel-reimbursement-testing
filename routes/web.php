<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PembayaranReimbursementController;
use App\Http\Controllers\ReimbursementController;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::redirect('/', '/dashboard', 301);

Route::middleware(['auth'])->group(function () {
    require('datatables.php');

    Route::get('/test', function() {
        $reimbur = Reimbursement::with('reimbursementApproval')
            ->whereHas('reimbursementApproval', function($q) {
                $q->where('status', true);
            })->get();

        dd($reimbur);
    });

    // dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Employee
    Route::prefix('/employee')->controller(EmployeeController::class)->as('employee.')->group(function() {
        Route::post('/{id}/change-password', 'changePassword')->name('change-password');
    });

    Route::resource('employee', EmployeeController::class)->except('show');

    // reimbursement
    Route::prefix('/reimbursement')->controller(ReimbursementController::class)->as('reimbursement.')->group(function() {
        Route::post('/{id}/approve', 'approveReimbursement')->name('approve');
    });

    Route::resource('reimbursement', ReimbursementController::class)->except('show');

    // Pembayaran Reimbursement
    Route::prefix('/pembayaran')->controller(PembayaranReimbursementController::class)->as('pembayaran.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/{id}/approve', 'approvePembayaran')->name('approve');
    });

});
