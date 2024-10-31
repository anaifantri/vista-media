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
                ->orWhere('code', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
            );
    }

    public function media_sizes(){
        return $this->hasMany(MediaSize::class, 'media_category_id', 'id');
    }

    public function locations(){
        return $this->hasMany(Location::class, 'media_category_id', 'id');
    }

    public function quotations(){
        return $this->hasMany(Quotation::class, 'media_category_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'media_category_id', 'id');
    }

    public function location_photos(){
        return $this->hasMany(LocationPhoto::class, 'media_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($media_category){
    //         $media_category->locations()->get()->each->delete();
    //         $media_category->location_photos()->get()->each->delete();
    //         $media_category->quotations()->get()->each->delete();
    //         $media_category->sales()->get()->each->delete();
    //         $media_category->media_sizess()->get()->each->delete();
    //     });
    // }

    public $sortable = ['name', 'code'];
}
