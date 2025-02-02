<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;


class PrintOrder extends Model
{
    use Sortable;
    protected $guarded = ['id'];
    
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
                return $query->whereDate('created_at', request('periode'));
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
            return $query->whereYear('created_at', request('year'));
        }else{
            return $query->whereYear('created_at', Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            if(request('month') != 'All'){
                return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
            }
        }
    }

    public function scopeDays($query){
        if(request('days')){
            if(request('days') != 'All'){
                return $query->whereDate('created_at', request('year').'-'.request('month').'-'.request('days'));
            }
        }
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
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('sale', function($query) use ($search){
                        $query->whereHas('quotation', function($query) use ($search){
                            $query->whereRaw('LOWER(JSON_EXTRACT(clients, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
                        })
                        ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.address")) like ?', ['"%' . strtolower($search) . '%"'])
                        ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.code")) like ?', ['"%' . strtolower($search) . '%"']);
                    })
                    ->orWhereHas('vendor', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('company', 'like', '%' . $search . '%');
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
