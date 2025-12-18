<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class InstallOrder extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeTakedown($query){
        return $query->whereDoesntHave('takedown_order');
    }

    public function scopeArea($query){
        if (request('area') != 'All') {
            return $query->whereHas('location', function($query){
                    return $query->where('area_id', 'like', '%' . request('area') . '%');
            });
        }
    }

    public function scopeCity($query){
        if (request('city') != 'All') {
            return $query->whereHas('location', function($query){
                    return $query->where('city_id', 'like', '%' . request('city') . '%');
            });
        }
    }

    public function scopePeriode($query){
        if(request('periode')){
            if(request('periode') != ""){
                return $query->whereDate('install_at', request('periode'));
            }
        }
    }

    public function scopeTodays($query){
        if (request('todays')) {
            return $query->whereDate('created_at', request('todays'));
        }
    }

    public function scopeWeekday($query){
        if (request('weekday') == true) {
            return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)]);
        }
    }

    public function scopeMonthly($query){
        if (request('monthly') == true) {
            return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
        }
    }

    public function scopeAnnual($query){
        if (request('annual') == true) {
            return $query->whereYear('created_at', Carbon::now()->year);
        }
    }

    public function scopeYear($query){
        if (request('year')) {
            return $query->whereYear('install_at', request('year'));
        }else{
            return $query->whereYear('install_at', Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            if(request('month') != 'All'){
                return $query->whereYear('install_at', request('year'))->whereMonth('install_at', request('month'));
            }
        }
    }

    public function scopeMonthReport($query){
        if(request('month')){
            if(request('month') != 'All'){
                return $query->whereYear('install_at', request('year'))->whereMonth('install_at', request('month'));
            }
        }else{
                return $query->whereYear('install_at', Carbon::now()->year)->whereMonth('install_at', Carbon::now()->month);
            }
    }

    public function scopeDays($query){
        if(request('days')){
            if(request('days') != 'All'){
                return $query->whereDate('install_at', request('year').'-'.request('month').'-'.request('days'));
            }
        }
    }

    public function scopePhoto($query, $filter){
        $query->when($filter ?? false, fn($query, $saleId) => 
                $query->where('product->main_sale_id', '=', $saleId)
                    ->orwhere('sale_id', '=', $saleId));
    }
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
                    ->orWhere('number', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('sale', function($query) use ($search){
                        $query->whereHas('quotation', function($query) use ($search){
                            $query->whereRaw('LOWER(JSON_EXTRACT(clients, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
                        });
                    })
                    ->orWhereHas('location', function($query) use ($search){
                        $query->where('code', 'like', '%' . $search . '%')
                            ->orWhere('address', 'like', '%' . $search . '%')
                            ->orWhereHas('area', function($query) use ($search){
                                $query->where('area', 'like', '%' . $search . '%');
                            })
                            ->orWhereHas('city', function($query) use ($search){
                                $query->where('city', 'like', '%' . $search . '%');
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
    public function takedown_order(){
        return $this->hasOne(TakedownOrder::class, 'install_order_id', 'id');
    }
    public function installation_photos(){
        return $this->hasMany(InstallationPhoto::class, 'install_order_id', 'id');
    }

    public $sortable = ['number'];
}
