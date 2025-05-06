<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class BillCoverLetter extends Model
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
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(content, "$.client.company")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(content, "$.category")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereHas('billings', function($query) use ($search){
                        $query->where('invoice_number', 'like', '%' . $search . '%');
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function billings()
    {
        return $this->belongsToMany(Billing::class, 'billing_letters');
    }

    public $sortable = ['number'];
}
