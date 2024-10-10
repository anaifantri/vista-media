<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Location extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeArea($query){
        if (request('area') != 'All') {
            return $query->where('area_id', 'like', '%' . request('area') . '%');
        }
    }

    public function scopeType($query){
        if (request('type') != 'All') {
            return $query->where('description', 'like', '%' . request('type') . '%');
        }
    }

    public function scopeCity($query){
        if (request('city') != 'All') {
            return $query->where('city_id', 'like', '%' . request('city') . '%');
        }
    }

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeCondition($query){
        if (request('condition') != 'All') {
            return $query->where('condition', 'like', '%' . request('condition') . '%');
        }
    }
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('condition', 'like', '%' . $search . '%')
                    ->orWhereHas('area', function($query) use ($search){
                        $query->where('area', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('city', function($query) use ($search){
                        $query->where('city', 'like', '%' . $search . '%');
                    })
                    // ->orWhereHas('media_category', function($query) use ($search){
                    //     $query->where('name', 'like', '%' . $search . '%');
                    // })
                    ->orWhereHas('media_size', function($query) use ($search){
                        $query->where('size', 'like', '%' . $search . '%');
                    })
                );
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function media_size(){
        return $this->belongsTo(MediaSize::class);
    }

    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function location_photos(){
        return $this->hasMany(LocationPhoto::class, 'location_id', 'id');
    }
    
    public function sales(){
        return $this->hasMany(Sale::class, 'location_id', 'id');
    }

    public static function boot(){
        parent::boot();

        static::deleting(function($location){
            $location->location_photos()->get()->each->delete();
            $location->sales()->get()->each->delete();
        });
    }

    public $sortable = ['code',
                        'price'
                        ];
}
