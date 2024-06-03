<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Signage;
use Kyslik\ColumnSortable\Sortable;

class SignageCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%'));
    }

    public function signages(){
        return $this->hasMany(Signage::class, 'signage_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['name'];
}
