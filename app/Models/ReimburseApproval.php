<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReimburseApproval extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reimburse_approvals';

    protected $fillable = [
        'reimbursement_id',
        'status',
        'note',
        'approved_by',
        'approval_date'
    ];

    public function reimbursement()
    {
        return $this->belongsTo(Reimbursement::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
