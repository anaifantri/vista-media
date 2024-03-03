<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCategory extends Model
{
    protected $guarded = ['id'];

    public function sales(){
        return $this->hasMany(Sale::class, 'sale_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
