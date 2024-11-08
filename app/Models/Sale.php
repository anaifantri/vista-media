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
                                    $query->where('name', '=', 'Billboard');
                    })
                    ->orWhereHas('media_category', function($query){
                                    $query->where('name', '=', 'Signage');
                    })
                    ->orWhere('product->description->type', '=', 'Neon Box')
                    ->orWhere('product->description->type', '=', 'Papan');
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
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('duration', 'like', '%' . $search . '%')
                    ->orWhere('created_by', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('quotation', function($query) use ($search){
                        $query->where('products', 'like', '%' . $search . '%')
                        ->orWhere('clients', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('location', function($query) use ($search){
                        $query->where('address', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('city', function($query) use ($search){
                            $query->where('city', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('area', function($query) use ($search){
                            $query->where('area', 'like', '%' . $search . '%');
                        });
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
