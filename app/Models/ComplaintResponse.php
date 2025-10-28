<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class ComplaintResponse extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeYear($query){
        if (request('year')) {
            return $query->whereYear('response_date', request('year'));
        }else{
            return $query->whereYear('response_date', Carbon::now()->year);
        }
    }
    
    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('response_date', request('year'))->whereMonth('response_date', request('month'));
        }else{
            return $query->whereYear('response_date', Carbon::now()->year)->whereMonth('response_date', Carbon::now()->month);
        }
    }
                
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
            $query->whereHas('sale', function($query) use ($search){
                $query->whereRaw('LOWER(JSON_EXTRACT(created_by, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.code")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.address")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.category")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.area")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.city")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereHas('quotation', function($query) use ($search){
                        $query->whereRaw('LOWER(JSON_EXTRACT(clients, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                            ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
                    });
                })
                ->orWhereHas('location', function($query) use ($search){
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
                })
        );
    }
        
    public function complaint(){
        return $this->belongsTo(Complaint::class);
    }
        
    public function user(){
        return $this->belongsTo(User::class);
    }
        
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public $sortable = ['response_date'];
}
