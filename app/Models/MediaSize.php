<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MediaSize extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('size', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhereHas('media_category', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function locations(){
        return $this->hasMany(Location::class, 'media_size_id', 'id');
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($media_size){
    //         $media_size->locations()->get()->each->delete();
    //     });
    // }

    public $sortable = ['code', 'size'];
}
