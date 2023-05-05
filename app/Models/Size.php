<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Size extends Model
{
    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class, 'size_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
