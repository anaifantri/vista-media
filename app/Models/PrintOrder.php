<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class PrintOrder extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('theme', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('sale', function($query) use ($search){
                        $query->WhereHas('quotation', function($query) use ($search){
                            $query->where('clients', 'like', '%' . $search . '%')
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
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function install_order(){
        return $this->hasOne(InstallOrder::class, 'print_order_id', 'id');
    }

    public $sortable = ['number'];
}
