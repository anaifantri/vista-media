<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MediaCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%'));
    }

    public function media_sizes(){
        return $this->hasMany(MediaSize::class, 'media_category_id', 'id');
    }

    public function locations(){
        return $this->hasMany(Location::class, 'media_category_id', 'id');
    }

    public function location_photos(){
        return $this->hasMany(LocationPhoto::class, 'media_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['name', 'code'];
}