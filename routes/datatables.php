<?php

use App\Http\Controllers\Datatables\EmployeeDatatablesController;
use Illuminate\Support\Facades\Route;

Route::prefix('/datatables')->as('datatables.')->namespace('Datatables')->group(function() {
	Route::get('/employee', [EmployeeDatatablesController::class, 'datalist'])
		->name('employee');
});
