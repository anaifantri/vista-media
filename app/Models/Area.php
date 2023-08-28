<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Videotron;
use Kyslik\ColumnSortable\Sortable;

class Area extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('area', 'like', '%' . $search . '%')
                    ->orWhere('provinsi', 'like', '%' . $search . '%'));
    }

    public function products(){
        return $this->hasMany(Product::class, 'area_id', 'id');
    }
    public function videotrons(){
        return $this->hasMany(Videotron::class, 'area_id', 'id');
    }
    public function signages(){
        return $this->hasMany(Signage::class, 'area_id', 'id');
    }

    public function cities(){
        return $this->hasMany(City::class, 'area_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['area_code',
                        'provinsi',
                        'area'
                        ];
}
