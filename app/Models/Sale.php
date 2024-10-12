<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Sale extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeArea($query, $filter){
        if (request('area') != 'All') {
            $query->when($filter ?? false, fn($query, $area) => 
                $query->whereHas('location', function($query) use ($area){
                        $query->whereHas('area', function($query) use ($area){
                            $query->where('area_id', 'like', '%' . $area . '%');
                        });
                    })
                );
        }
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('duration', 'like', '%' . $search . '%')
                    ->orWhere('created_by', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('quotation', function($query) use ($search){
                        $query->where('products', 'like', '%' . $search . '%')
                        ->orWhere('clients', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('location', function($query) use ($search){
                        $query->where('address', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('city', function($query) use ($search){
                            $query->where('city', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('area', function($query) use ($search){
                            $query->where('area', 'like', '%' . $search . '%');
                        });
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function install_order(){
        return $this->hasOne(InstallOrder::class, 'sale_id', 'id');
    }

    public function print_order(){
        return $this->hasOne(PrintOrder::class, 'sale_id', 'id');
    }

    public $sortable = ['number'];
}
