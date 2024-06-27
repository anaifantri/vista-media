<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintInstallOrder extends Model
{
    protected $guarded = ['id'];

   public function print_instal_quotation(){
        return $this->belongsTo(PrintInstalQuotation::class);
    }
}
