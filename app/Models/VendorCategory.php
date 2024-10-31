<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class VendorCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('code', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
            );
    }

    public function vendors(){
        return $this->hasMany(Vendor::class, 'vendor_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($vendor_category){
    //         $vendor_category->vendors()->get()->each->delete();
    //     });
    // }

    public $sortable = ['name', 'code'];
}
