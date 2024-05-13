<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use App\Models\Led;
// use App\Models\Vendor;
use App\Models\SignageCategory;
use App\Models\Quotation;
use Kyslik\ColumnSortable\Sortable;

class Signage extends Model
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

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
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
    public function led(){
        return $this->belongsTo(Led::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function signage_category(){
        return $this->belongsTo(SignageCategory::class);
    }

    public function quotations(){
        return $this->hasMany(Quotation::class, 'signage_id', 'id');
    }

    public function signage_photos(){
        return $this->hasMany(SignagePhoto::class, 'signage_id', 'id');
    }

    public $sortable = ['code',
                        'exclusive_price',
                        'sharing_price',
                        'price'
                        ];
}
