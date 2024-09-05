<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignageApproval extends Model
{
    protected $guarded = ['id'];

    public function signagen_quotation(){
        return $this->belongsTo(SignagenQuotation::class);
    }

    public function signagen_quot_revision(){
        return $this->belongsTo(SignagenQuotRevision::class);
    }
}
