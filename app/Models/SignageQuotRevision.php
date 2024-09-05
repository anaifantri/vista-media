<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignageQuotRevision extends Model
{
    protected $guarded = ['id'];

    public function signage_quotation(){
        return $this->belongsTo(SignageQuotation::class);
    }

    public function signage_quot_statuses(){
        return $this->hasMany(SignageQuotStatus::class, 'signage_quot_revision_id', 'id');
    }

    public function signage_approvals(){
        return $this->hasMany(SignageApproval::class, 'signage_quot_revision_id', 'id');
    }

    public function signage_orders(){
        return $this->hasMany(SignageOrder::class, 'signage_quot_revision_id', 'id');
    }

    public function signage_agreements(){
        return $this->hasMany(SignageAgreement::class, 'signage_quot_revision_id', 'id');
    }
}
