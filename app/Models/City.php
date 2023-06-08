<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Kyslik\ColumnSortable\Sortable;

class City extends Model
{
    use Sortable;
    
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

    public $sortable = ['city'];
}
