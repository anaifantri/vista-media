<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotRevisionStatus extends Model
{
    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }
    public function quotation_revision(){
        return $this->belongsTo(QuotationRevision::class);
    }
}
