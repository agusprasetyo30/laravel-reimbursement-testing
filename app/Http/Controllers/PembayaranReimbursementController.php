<?php

namespace App\Http\Controllers;

use App\Models\PembayaranReimbursement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pembayaran.index');
    }

    /**
     * Use to initialize approve and rejected data
     *
     * @param Request $request
     * @param [type] $id
     * @return json
     */
    public function approvePembayaran(Request $request, $id) {
        $pembayaran = PembayaranReimbursement::create([
            'reimbursement_id'  => $request->reimbursement_id,
            'status'            => $request->status, // cek status. Approve = 1, Rejected = 0
            'note'              => $request->note,
            'process_by'       => \Auth::user()->id,
            'process_date'     => Carbon::now()->format('Y-m-d')
        ]);

        return $this->success($pembayaran, "Approval pembayaran success!");
    }
}
