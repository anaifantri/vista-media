<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Videotron;
use App\Models\Led;
use App\Models\Product;
use App\Models\VendorContact;
use Kyslik\ColumnSortable\Sortable;

class Vendor extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhereHas('vendor_category', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    }));
    }

    public function leds(){
        return $this->hasMany(Led::class, 'vendor_id', 'id');
    }

    public function vendor_category(){
        return $this->belongsTo(VendorCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }
    public function videotrons(){
        return $this->hasMany(Videotron::class, 'vendor_id', 'id');
    }

    public function vendor_contacts(){
        return $this->hasMany(VendorContact::class, 'vendor_id', 'id');
    }

    public $sortable = ['name','company'];
}
