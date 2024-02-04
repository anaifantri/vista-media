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
        return $this->hasMany(BillboardPhoto::class, 'billboard_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
