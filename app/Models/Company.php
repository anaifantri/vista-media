<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardPhoto;
use App\Models\BillboardQuotation;

class Company extends Model
{
    protected $guarded = ['id'];
    
    public function billboard_photos(){
        return $this->hasMany(BillboardPhoto::class, 'company_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'company_id', 'id');
    }
}
