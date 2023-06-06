<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = ['id'];

    public function leds(){
        return $this->hasMany(Led::class, 'vendor_id', 'id');
    }

    public function vendor_category(){
        return $this->belongsTo(VendorCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }

    public function vendor_contacts(){
        return $this->hasMany(VendorContact::class, 'vendor_id', 'id');
    }
}
