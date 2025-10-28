<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Complaint extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeYear($query){
        if (request('year')) {
            return $query->whereYear('complaint_date', request('year'));
        }else{
            return $query->whereYear('complaint_date', Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('complaint_date', request('year'))->whereMonth('complaint_date', request('month'));
        }else{
            return $query->whereYear('complaint_date', Carbon::now()->year)->whereMonth('complaint_date', Carbon::now()->month);
        }
    }
    
    public function scopeOpen($query){
        return $query->whereDoesntHave('complaint_response');
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
        
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function complaint_response(){
        return $this->hasOne(ComplaintResponse::class, 'complaint_id', 'id');
    }
    
    public $sortable = ['complaint_date'];
}
