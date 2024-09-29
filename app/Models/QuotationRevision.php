<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationRevision extends Model
{
    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }

    public function quot_revision_statuses(){
        return $this->hasMany(QuotRevisionStatus::class, 'quotation_revision_id', 'id');
    }

    public function quot_revision_approvals(){
        return $this->hasMany(QuotRevisionApproval::class, 'quotation_revision_id', 'id');
    }
}
