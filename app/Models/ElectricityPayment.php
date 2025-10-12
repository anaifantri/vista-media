<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class ElectricityPayment extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeYear($query){
        if (request('year')) {
            return $query->whereYear('payment_date', request('year'));
        }else{
            return $query->whereYear('payment_date', Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('payment_date', request('year'))->whereMonth('payment_date', request('month'));
        }else{
            return $query->whereYear('payment_date', Carbon::now()->year)->whereMonth('payment_date', Carbon::now()->month);
        }
    }

    public function scopeArea($query){
        if (request('area') != 'All') {
            return $query->whereHas('electrical_power', function($query){
                        $query->where('area_id', 'like', '%' . request('area') . '%');
                    });
        }
    }
    
    public function scopeCity($query){
        if (request('city') != 'All') {
            return $query->whereHas('electrical_power', function($query){
                        $query->where('city_id', 'like', '%' . request('city') . '%');
                    });
        }
    }
            
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->whereHas('electrical_power', function($query) use ($search){
                        $query->where('id_number', 'like', '%' . $search . '%')
                            ->where('name', 'like', '%' . $search . '%')
                            ->where('power', 'like', '%' . $search . '%')
                            ->orWhereHas('area', function($query) use ($search){
                                $query->where('area', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('city', function($query) use ($search){
                                $query->where('city', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('locations', function($query) use ($search){
                                $query->where('code', 'like', '%' . $search . '%')
                                    ->orWhere('address', 'like', '%' . $search . '%');
                            });
                    })
                );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function electrical_power(){
        return $this->belongsTo(ElectricalPower::class);
    }

    public $sortable = ['payment_date', 'bill_date'];
}
