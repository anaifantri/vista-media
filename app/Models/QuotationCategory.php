<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationCategory extends Model
{
    protected $guarded = ['id'];

    public function quotations(){
        return $this->hasMany(Quotation::class, 'quotation_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
