<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home', [
            'total_admin' => User::all()->count(),
            'total_reimburse' => Reimbursement::all()->count(),
            'pembayaran_approve' => Reimbursement::whereHas('pembayaranReimbursement', function($q) {
                    $q->where('status', 1);
                })->count()
        ]);
    }
}
