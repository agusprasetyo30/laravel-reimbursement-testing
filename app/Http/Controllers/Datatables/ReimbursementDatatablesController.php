<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;

class ReimbursementDatatablesController extends Controller
{
    /**
     * list data in datatables employee
     *
     * @param Request $request
     * @return void
     */
    public function datalist(Request $request)
    {
        $data = Reimbursement::orderBy('id', 'asc')->get();

        return datatables($data)
            ->addColumn('date_formatted', function($reimbursement) {
                return Carbon::parse($reimbursement->date)->format('d F Y');
            })
            ->addColumn('document_formatted', function($reimbursement) {
                return "<a class='btn btn-sm btn-primary' href='". asset('storage/' . $reimbursement->document_file_path) ."' target='_blank'>Document!</a>";
            })
            ->addColumn('status_formatted', function($reimbursement) {
                if ($reimbursement->reimbursementApproval) {
                    if ($reimbursement->reimbursementApproval->status) {
                        return "<div class='badge badge-success'>Approved</div>";
                    } else {
                        return "<div class='badge badge-danger'>Rejected</div><br>
                        <small>{$reimbursement->reimbursementApproval->note}</small>";
                    }
                } else {
                    return "<div class='badge badge-warning'>Draft</div>";
                }
            })
            ->addColumn('actions', function($reimbursement) {
                $edit_button = "";
                $delete_button = "";
                $approve_button = "";

                if (Gate::check('edit-reimbursement')) {
                    $edit_button = "<a href='". route('reimbursement.edit', $reimbursement->id) ."' class='btn btn-icon btn-primary' title='Edit Reimburse Document'><i class='fas fa-edit'></i></a>";
                }

                if (Gate::check('destroy-reimbursement')) {
                    $delete_button = "<button id='delete_button' class='btn btn-icon btn-danger' data-delete-route='" . route('reimbursement.destroy', ':id') . "' title='Delete Reimburse Document'><i class='fas fa-trash'></i></button>";
                }

                if (Gate::check('approve-reimbursement')) {
                    $approve_button = "<button id='approve_button' class='btn btn-icon btn-success' data-approve-route='" . route('reimbursement.approve', ':id') . "' title='Approve Reimburse Document'><i class='fas fa-check'></i></button>";
                }

                // Digunakan untuk menampilkan approved by dan menghilangkan tombol
                if ($reimbursement->reimbursementApproval) {
                    $employee = "<b>" . $reimbursement->reimbursementApproval->employee->name . "</b>";
                    $date_approval = "<span class='badge badge-pill badge-primary' style='font-size: 10px'>". Carbon::parse($reimbursement->reimbursementApproval->approval_date)->format('d F Y') ."</span>";

                    return $employee . '<br>' . $date_approval;

                } else {
                    // Menampilkan tombol ketika data belum di approved / rejected
                    return "
                        <div class='button'>
                            {$edit_button} {$delete_button} {$approve_button}
                        </div>
                    ";
                }
            })

            ->escapeColumns([])
            ->make();
    }
}
