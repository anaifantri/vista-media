<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class, 'product_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
