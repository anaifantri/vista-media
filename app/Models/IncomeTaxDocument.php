<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class IncomeTaxDocument extends Model
{
    use Sortable;
    protected $guarded = ['id'];
        
    public function scopePeriod($query){
        if(request('period')){
            return $query->where('period', request('period'));
        }else{
            return $query->where('period', "");
        }
    }
        
    public function scopeYearReport($query){
        if(request('year')){
            return $query->whereYear('tax_date', request('year'));
        }else{
            return $query->whereYear('tax_date',  Carbon::now()->year);
        }
    }
        
    public function scopeYear($query){
        if(request('year')){
            return $query->whereYear('created_at', request('year'));
        }else{
            return $query->whereYear('created_at',  Carbon::now()->year);
        }
    }

    public function scopeMonthReport($query){
        if(request('month')){
            return $query->whereYear('tax_date', request('year'))->whereMonth('tax_date', request('month'));
        }else{
            return $query->whereYear('tax_date',  Carbon::now()->year)->whereMonth('tax_date', Carbon::now()->month);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
        }else{
            return $query->whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
        }
    }
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                );
    }
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    
    public $sortable = ['number'];
}
