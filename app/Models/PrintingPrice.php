<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrintingProduct;

class PrintingPrice extends Model
{
    protected $guarded = ['id'];

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

}
