<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billboard;
use Kyslik\ColumnSortable\Sortable;

class BillboardCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%'));
    }

    public function billboards(){
        return $this->hasMany(Billboard::class, 'billboard_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['name'];
}
