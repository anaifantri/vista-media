<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Sale extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeMonth($query){
        return $query->where('created_at', 'like', '%' . request('monthSearch') . '%');
    }

    public function scopeArea($query){
        if (request('area') != 'All') {
                $query->whereHas('location', function($query){
                        $query->whereHas('area', function($query){
                            $query->where('area_id', 'like', '%' . request('area') . '%');
                        });
                    });
        }
    }

    public function scopeCity($query){
        if (request('city') != 'All') {
                $query->whereHas('location', function($query){
                        $query->whereHas('city', function($query){
                            $query->where('city_id', 'like', '%' . request('city') . '%');
                        });
                    });
        }
    }
    public function scopeService($query){
        return $query->where('end_at', '>', date('Y-m-d'))
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Videotron');
                    })
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Service');
                    })
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Signage');
                    })
                    ->orWhereJsonContains('product->description->type','Neon Box')
                    ->orWhereJsonContains('product->description->type','Papan');
    }
    public function scopePrint($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '==', 'Service');
                    });
    }
    public function scopeInstall($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '==', 'Service');
                    });
    }
    public function scopeFree($query){
        return $query->whereHas('quotation', function($query){
                    $query->where('notes->freePrint', '>', 0);
                });
    }
    public function scopeFreeInstall($query){
        return $query->whereHas('quotation', function($query){
                    $query->where('notes->freeInstall', '>', 0);
                });
    }

    public function scopeFilter($query, $filter){
        // $filter = ucfirst($filter);
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('duration', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(created_by, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.code")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.address")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.category")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.area")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.city")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereHas('quotation', function($query) use ($search){
                        $query->whereRaw('LOWER(JSON_EXTRACT(clients, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                        ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function install_order(){
        return $this->hasOne(InstallOrder::class, 'sale_id', 'id');
    }
    public function install_orders(){
        return $this->hasMany(InstallOrder::class, 'sale_id', 'id');
    }

    public function print_order(){
        return $this->hasOne(PrintOrder::class, 'sale_id', 'id');
    }

    public function print_orders(){
        return $this->hasMany(PrintOrder::class, 'sale_id', 'id');
    }

    public $sortable = ['number'];
}
