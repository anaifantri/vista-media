<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class IncomeTax extends Model
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
    public function billing(){
        return $this->belongsTo(Billing::class);
    }
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public $sortable = ['number'];
}
