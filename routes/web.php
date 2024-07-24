<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReimbursementController;
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
    // dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Employee
    Route::resource('employee', EmployeeController::class);

    // reimbursement
    Route::prefix('/reimbursement')->controller(ReimbursementController::class)->as('reimbursement.')->group(function() {
        Route::get('/', 'index')->name('index');

        // Route::resource('/', ReimbursementController::class);
    });
});
