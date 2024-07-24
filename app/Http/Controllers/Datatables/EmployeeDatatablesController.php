<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class EmployeeDatatablesController extends Controller
{
    /**
     * list data in datatables employee
     *
     * @param Request $request
     * @return void
     */
    public function datalist(Request $request)
    {
        $data = User::query();

        return datatables($data)
            ->addColumn('role_formatted', function($employee) {
                return "<div class='badge badge-success'>" . ucfirst($employee->role) . "</div>";
            })
            ->addColumn('actions', function($employee) {
                $edit_button = "";
                $delete_button = "";

                if (Gate::check('edit-user')) {
                    $edit_button = "<a href='". route('employee.edit', $employee->id) ."' class='btn btn-icon btn-primary'><i class='fas fa-edit'></i></a>";
                }

                if (Gate::check('destroy-user')) {
                    $delete_button = "<button id='delete_button' class='btn btn-icon btn-danger' data-delete-route='" . route('employee.destroy', $employee->id) . "'><i class='fas fa-trash'></i></button>";
                }

                return "
                    <div class='button'>
                        {$edit_button} {$delete_button}
                    </div>
                ";
            })

            ->escapeColumns([])
            ->make();
    }
}
