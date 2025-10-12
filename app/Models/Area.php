<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Area extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('area', 'like', '%' . $search . '%')
                    ->orWhere('area_code', 'like', '%' . $search . '%')
                    ->orWhere('area_code', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }
    public function locations(){
        return $this->hasMany(Location::class, 'area_id', 'id');
    }

    public function cities(){
        return $this->hasMany(City::class, 'area_id', 'id');
    }

    public function electrical_powers(){
        return $this->hasMany(ElectricalPower::class, 'area_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($area){
    //         $area->cities()->get()->each->delete();
    //         $area->locations()->get()->each->delete();
    //     });
    // }

    public $sortable = ['area_code',
                        'area'
                        ];
}
