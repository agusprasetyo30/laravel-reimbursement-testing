<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;

class PembayaranDatatablesController extends Controller
{
    /**
     * list data in datatables employee
     *
     * @param Request $request
     * @return void
     */
    public function datalist(Request $request)
    {
        $data = Reimbursement::with('reimbursementApproval')
            ->whereHas('reimbursementApproval', function($q) {
                $q->where('status', true);
            })->get();

        return datatables($data)
            ->addColumn('date_formatted', function($reimbursement) {
                return Carbon::parse($reimbursement->date)->format('d F Y');
            })
            ->addColumn('document_formatted', function($reimbursement) {
                return "<a class='btn btn-sm btn-primary' href='". asset('storage/' . $reimbursement->document_file_path) ."' target='_blank'>Document!</a>";
            })
            ->addColumn('status_formatted', function($reimbursement) {
                if ($reimbursement->pembayaranReimbursement) {
                    if ($reimbursement->pembayaranReimbursement->status) {
                        return "<div class='badge badge-success'>Sudah Dibayarkan</div>";
                    } else {
                        return "<div class='badge badge-danger'>Dibatalkan</div><br>
                        <small>{$reimbursement->pembayaranReimbursement->note}</small>";
                    }
                } else {
                    return "<div class='badge badge-warning'>Dalam Proses</div>";
                }
            })
            ->addColumn('actions', function($reimbursement) {
                $approve_button = "-";

                if (Gate::check('approve-pembayaran') && !$reimbursement->pembayaranReimbursement) {
                    $approve_button = "<button id='approve_button' class='btn btn-icon btn-success' data-approve-route='" . route('pembayaran.approve', ':id') . "' title='Approve Pembayaran Reimburse Document'><i class='fas fa-money-bill-wave-alt'></i>Pembayaran</button>";
                }

                // Digunakan untuk menampilkan data berdasarkan data approved pembayaran
                if (!$reimbursement->pembayaranReimbursement) {
                    return "
                        <div class='button'>
                            {$approve_button}
                        </div>
                    ";
                } else {
                    return $approve_button;
                }
            })

            ->escapeColumns([])
            ->make();
    }
}
