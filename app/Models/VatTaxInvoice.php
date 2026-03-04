<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class VatTaxInvoice extends Model
{
    use Sortable;
    protected $guarded = ['id'];
        
    public function scopeYear($query){
        if(request('year')){
            return $query->whereYear('tax_date', request('year'));
        }else{
            return $query->whereYear('tax_date',  Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('tax_date', request('year'))->whereMonth('tax_date', request('month'));
        }else{
            return $query->whereYear('tax_date',  Carbon::now()->year)->whereMonth('tax_date', Carbon::now()->month);
        }
    }
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('billing', function($query) use ($search){
                        $query->where('invoice_number', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(client, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
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
