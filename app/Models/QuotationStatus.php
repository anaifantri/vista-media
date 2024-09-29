<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationStatus extends Model
{
    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }
}
