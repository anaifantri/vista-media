<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class VatTaxInvoice extends Model
{
    use Sortable;
    protected $guarded = ['id'];
        
    public function scopeYear($query){
        if(request('year')){
            return $query->whereYear('created_at', request('year'));
        }else{
            return $query->whereYear('created_at',  Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
        }
    }
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('billing', function($query) use ($search){
                        $query->where('invoice_number', 'like', '%' . $search . '%')
                            ->orWhere('client', 'like', '%' . $search . '%');
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function billing(){
        return $this->belongsTo(Billing::class);
    }

    public $sortable = ['number'];
}
