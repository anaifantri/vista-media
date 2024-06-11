<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintInstallSale extends Model
{
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function w_o_prints(){
        return $this->hasMany(WOPrint::class, 'print_install_sale_id', 'id');
    }

    public function w_o_installs(){
        return $this->hasMany(WOInstall::class, 'print_install_sale_id', 'id');
    }
}
