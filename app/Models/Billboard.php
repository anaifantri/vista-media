<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\BillboardQuotation;
use App\Models\BillboardCategory;
use Kyslik\ColumnSortable\Sortable;

class Billboard extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeArea($query){
        if (request('area') != 'All') {
            return $query->where('area_id', 'like', '%' . request('area') . '%');
        }
    }

    public function scopeCity($query){
        $dataCity = request('requestCity');

        if (request('area') != request('requestArea')) {
            $dataCity = '';
        }
        if ($dataCity != 'All') {
            return $query->where('city_id', 'like', '%' . $dataCity . '%');
        }
    }

    public function scopeCondition($query){
        if (request('condition') != 'All') {
            return $query->where('condition', 'like', '%' . request('condition') . '%');
        }
    }

    // public function scopeStatus($query){
    //     if (request('sale') != 'All') {
    //         return $query->where('sale_status', 'like', '%' . request('sale') . '%');
    //     }
    // }
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('condition', 'like', '%' . $search . '%')
                    ->orWhereHas('area', function($query) use ($search){
                        $query->where('area', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('city', function($query) use ($search){
                        $query->where('city', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('size', function($query) use ($search){
                        $query->where('size', 'like', '%' . $search . '%');
                    })
                );
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function billboard_category(){
        return $this->belongsTo(BillboardCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billboard_quotations(){
        return $this->hasMany(BillboardQuotation::class, 'billboard_id', 'id');
    }

    public function billboard_photos(){
        return $this->hasMany(BillboardPhoto::class, 'billboard_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'billboard_id', 'id');
    }

    public function print_install_sales(){
        return $this->hasMany(PrintInstallSale::class, 'billboard_id', 'id');
    }

    public $sortable = ['code',
                        'price'
                        ];
}
