<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class TakedownOrder extends Model
{
    use Sortable;
    protected $guarded = ['id'];
    
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
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('theme', 'like', '%' . $search . '%')
                    ->orWhere('takedown_at', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('location', function($query) use ($search){
                        $query->where('code', 'like', '%' . $search . '%')
                            ->orWhere('address', 'like', '%' . $search . '%');
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function install_order(){
        return $this->belongsTo(InstallOrder::class);
    }

    public $sortable = ['number'];
}
