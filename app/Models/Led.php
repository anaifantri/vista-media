<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Videotron;
use App\Models\Vendor;
use App\Models\Product;
use Kyslik\ColumnSortable\Sortable;

class Led extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('pixel_pitch', 'like', '%' . $search . '%')
                    ->orWhereHas('vendor', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    }));
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class, 'led_id', 'id');
    }
    public function videotrons(){
        return $this->hasMany(Videotron::class, 'vendor_id', 'id');
    }

    public $sortable = ['name', 'pixel_pitch'];
}
