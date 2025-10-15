<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ElectricalPower extends Model
{
    use Sortable;
    protected $guarded = ['id'];
    
    public function scopeType($query){
        if (request('type') != 'All') {
            return $query->where('type', 'like', '%' . request('type') . '%');
        }
    }
    
    public function scopeArea($query){
        if (request('area') != 'All') {
            return $query->where('area_id', 'like', '%' . request('area') . '%');
        }
    }
    
    public function scopeCity($query){
        if (request('city') != 'All') {
            return $query->where('city_id', 'like', '%' . request('city') . '%');
        }
    }
        
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('id_number', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('power', 'like', '%' . $search . '%')
                    ->orWhereHas('area', function($query) use ($search){
                        $query->where('area', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('city', function($query) use ($search){
                        $query->where('city', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('locations', function($query) use ($search){
                        $query->where('code', 'like', '%' . $search . '%')
                            ->orWhere('address', 'like', '%' . $search . '%');
                    })
                );
    }
    
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'electrical_locations');
    }

    public function electricity_top_ups(){
        return $this->hasMany(ElectricityTopUp::class, 'electrical_power_id', 'id');
    }

    public function electricity_payments(){
        return $this->hasMany(ElectricityPayment::class, 'electrical_power_id', 'id');
    }

    public $sortable = ['id_number'];
}
