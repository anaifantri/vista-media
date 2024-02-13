<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardQuotation;
use App\Models\BillboardQuotRevision;

class BillboardQuotStatus extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billboard_quotation(){
        return $this->belongsTo(BillboardQuotation::class);
    }

    public function billboard_quot_revision(){
        return $this->belongsTo(BillboardQuotRevision::class);
    }
}
