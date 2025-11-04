<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class PublishContent extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeYear($query){
        if (request('year')) {
            return $query->whereYear('publish_date', request('year'));
        }else{
            return $query->whereYear('publish_date', Carbon::now()->year);
        }
    }
    
    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('publish_date', request('year'))->whereMonth('publish_date', request('month'));
        }else{
            return $query->whereYear('publish_date', Carbon::now()->year)->whereMonth('publish_date', Carbon::now()->month);
        }
    }
    
    public function scopeTakeout($query){
        return $query->whereDoesntHave('take_out_content');
    }
                
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
            $query->where('theme', 'like', '%' . $search . '%')
                ->orWhereHas('sale', function($query) use ($search){
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

    public function take_out_content(){
        return $this->hasOne(TakeOutContent::class, 'publish_content_id', 'id');
    }
    
    public $sortable = ['publish_date'];
}
