<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class City extends Model
{
    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class, 'city_id', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
