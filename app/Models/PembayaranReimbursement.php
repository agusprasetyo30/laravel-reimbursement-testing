<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranReimbursement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pembayaran_reimbursements";

    protected $fillable = [
        'reimbursement_id',
        'status',
        'note',
        'process_by',
        'process_date'
    ];

    public function reimbursement()
    {
        return $this->belongsTo(Reimbursement::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'process_by');
    }
}
