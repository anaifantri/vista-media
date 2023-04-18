<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\City;
use App\Models\ProductCategory;
use App\Models\Size;

class Product extends Model
{
    protected $guarded = ['id'];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function product_category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }
}
