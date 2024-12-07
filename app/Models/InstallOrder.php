<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class InstallOrder extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeSales($query){
        return $query->where('product->order_type', '=', 'sales');
    }
    public function scopeFreeSales($query){
        return $query->where('product->order_type', '=', 'free');
    }
    public function scopeFreeOther($query){
        return $query->where('product->order_type', '=', 'location');
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('theme', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhereHas('sale', function($query) use ($search){
                        $query->WhereHas('quotation', function($query) use ($search){
                            $query->where('client', 'like', '%' . $search . '%')
                            ->orWhere('products', 'like', '%' . $search . '%');
                        });
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function print_order(){
        return $this->belongsTo(PrintOrder::class);
    }

    public $sortable = ['number'];
}
