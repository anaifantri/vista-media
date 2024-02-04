<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Billboard;
use Kyslik\ColumnSortable\Sortable;

class Size extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('size', 'like', '%' . $search . '%')
                    ->orWhere('side', 'like', '%' . $search . '%')
                    ->orWhere('orientation', 'like', '%' . $search . '%'));
    }

    // public function products(){
    //     return $this->hasMany(Product::class, 'size_id', 'id');
    // }
    public function billboards(){
        return $this->hasMany(Billboard::class, 'size_id', 'id');
    }
    public function videotrons(){
        return $this->hasMany(Videotron::class, 'size_id', 'id');
    }
    public function signages(){
        return $this->hasMany(Signage::class, 'size_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['size',
                        'side',
                        'orientation'
                        ];
}
