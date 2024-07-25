<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reimbursement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'date',
        'description',
        'document_file_name',
        'document_file_path',
    ];

    public function reimbursementApproval()
    {
        return $this->hasOne(ReimburseApproval::class);
    }

    public function pembayaranReimbursement()
    {
        return $this->hasOne(PembayaranReimbursement::class);
    }


}
