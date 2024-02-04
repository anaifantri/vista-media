<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardQuotation;

class BillboardQuoteRevision extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billboard_quotation(){
        return $this->belongsTo(BillboardQuotation::class);
    }
}
