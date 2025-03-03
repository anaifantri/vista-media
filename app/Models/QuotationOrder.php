<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationOrder extends Model
{
    protected $guarded = ['id'];

    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
