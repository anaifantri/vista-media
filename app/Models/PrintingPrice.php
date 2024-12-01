<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PrintingPrice extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeVendor($query){
        if (request('vendorId') != 'pilih') {
            return $query->where('vendor_id', 'like', '%' . request('vendorId') . '%');
        }
    }

    public function scopeProduct($query){
        if (request('productType')) {
            return $query->whereHas('printing_product', function($query){
                $query->where('type', 'like', '%' . request('productType') . '%');
            });
        }
    }

    public function scopeName($query){
        if (request('productName')) {
            return $query->whereHas('printing_product', function($query){
                $query->where('name', 'like', '%' . request('productName') . '%');
            });
        }
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->WhereHas('printing_product', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('vendor', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }

    public function printing_product(){
        return $this->belongsTo(PrintingProduct::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public $sortable = ['code'];
}
