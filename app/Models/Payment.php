<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Payment extends Model
{
    use Sortable;
    protected $guarded = ['id'];
            
    public function scopeYearReport($query){
        if(request('year')){
            return $query->whereYear('payment_date', request('year'));
        }else{
            return $query->whereYear('payment_date',  Carbon::now()->year);
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
            return $query->whereYear('payment_date', request('year'))->whereMonth('payment_date', request('month'));
        }else{
            return $query->whereYear('payment_date',  Carbon::now()->year)->whereMonth('payment_date', Carbon::now()->month);
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
                $query->whereHas('billings', function($query) use ($search){
                        $query->where('invoice_number', 'like', '%' . $search . '%')
                            ->orWhereRaw('LOWER(JSON_EXTRACT(client, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
                    })
                );
    }
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function billings()
    {
        return $this->belongsToMany(Billing::class, 'billing_payments');
    }    

    public function income_taxes(){
        return $this->hasMany(IncomeTax::class, 'payment_id', 'id');
    }
    
    public function income_tax_document(){
        return $this->hasOne(IncomeTaxDocument::class, 'payment_id', 'id');
    }

    public $sortable = ['number'];
}
