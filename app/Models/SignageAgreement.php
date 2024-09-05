<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignageAgreement extends Model
{
    protected $guarded = ['id'];

    public function signage_quotation(){
        return $this->belongsTo(SignageQuotation::class);
    }

    public function signage_quot_revision(){
        return $this->belongsTo(SignageQuotRevision::class);
    }
}
