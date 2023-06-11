<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
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

    public function scopeBuild($query){
        if (request('build') != 'All') {
            return $query->where('build_status', 'like', '%' . request('build') . '%');
        }
    }

    public function scopeStatus($query){
        if (request('sale') != 'All') {
            return $query->where('sale_status', 'like', '%' . request('sale') . '%');
        }
    }
    
    public function scopeFilter($query){
        if(request('search')){
            return $query->where('code', 'like', '%' . request('search') . '%')
                  ->orWhere('address', 'like', '%' . request('search') . '%');
        }
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['code',
                        'price',
                        'start_contract',
                        'end_contract'
                        ];
}
