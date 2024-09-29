<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationAgreement extends Model
{
    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }
}
