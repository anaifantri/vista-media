<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WOInstall extends Model
{
    protected $guarded = ['id'];

    public function print_instal_quotation(){
        return $this->belongsTo(PrintInstalQUotation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function print_install_sale(){
        return $this->belongsTo(PrintInstallSale::class);
    }
    
}
