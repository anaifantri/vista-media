<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Billboard;
use App\Models\Videotron;
use Kyslik\ColumnSortable\Sortable;

class City extends Model
{
    use Sortable;
    
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('city', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('area', function($query) use ($search){
                            $query->where('area', 'like', '%' . $search . '%');
                        });
        });
    }

    // public function products(){
    //     return $this->hasMany(Product::class, 'city_id', 'id');
    // }
    public function billboards(){
        return $this->hasMany(Billboard::class, 'city_id', 'id');
    }

    public function videotrons(){
        return $this->hasMany(Videotron::class, 'city_id', 'id');
    }
    public function signages(){
        return $this->hasMany(Signage::class, 'city_id', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['city'];
}
