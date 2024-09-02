<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideotronQuotationApproval extends Model
{
    protected $guarded = ['id'];

    public function videotron_quotation(){
        return $this->belongsTo(VideotronQuotation::class);
    }

    public function videotron_quot_revision(){
        return $this->belongsTo(VideotronQuotRevision::class);
    }
}
