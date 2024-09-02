<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideotronQuotRevision extends Model
{
    protected $guarded = ['id'];

    public function videotron_quotation(){
        return $this->belongsTo(VideotronQuotation::class);
    }

    public function videotron_quot_statuses(){
        return $this->hasMany(VideotronQuotStatus::class, 'videotron_quot_revision_id', 'id');
    }

    public function videotron_quotation_approvals(){
        return $this->hasMany(VideotronQuotationApproval::class, 'videotron_quot_revision_id', 'id');
    }

    public function videotron_quotation_orders(){
        return $this->hasMany(VideotronQuotationOrder::class, 'videotron_quot_revision_id', 'id');
    }

    public function videotron_quot_agreements(){
        return $this->hasMany(VideotronQuotAgreement::class, 'videotron_quot_revision_id', 'id');
    }
}
