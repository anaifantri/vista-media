<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    protected $guarded = ['id'];

    public function vendors(){
        return $this->hasMany(Vendor::class, 'vendor_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
