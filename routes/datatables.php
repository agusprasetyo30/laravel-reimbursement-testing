<?php

use App\Http\Controllers\Datatables\EmployeeDatatablesController;
use App\Http\Controllers\Datatables\PembayaranDatatablesController;
use App\Http\Controllers\Datatables\ReimbursementDatatablesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/datatables')->as('datatables.')->namespace('Datatables')->group(function() {
	Route::get('/employee', [EmployeeDatatablesController::class, 'datalist'])
		->name('employee');

	Route::get('/reimbursement', [ReimbursementDatatablesController::class, 'datalist'])
		->name('reimbursement');

	Route::get('/pembayaran', [PembayaranDatatablesController::class, 'datalist'])
		->name('pembayaran');
});
