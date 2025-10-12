<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class City extends Model
{
    use Sortable;
    
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('city', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhereHas('area', function($query) use ($search){
                            $query->where('area', 'like', '%' . $search . '%');
                        });
        });
    }

    public function locations(){
        return $this->hasMany(Location::class, 'city_id', 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }
    
    public function electrical_powers(){
        return $this->hasMany(ElectricalPower::class, 'area_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($city){
    //         $city->locations()->get()->each->delete();
    //     });
    // }

    public $sortable = ['city'];
}
