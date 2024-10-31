<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Led extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('pixel_pitch', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('refresh_rate', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('brightness', 'like', '%' . $search . '%')
                    ->orWhere('cabinet_weight', 'like', '%' . $search . '%')
                    ->orWhere('cabinet_material', 'like', '%' . $search . '%')
                    ->orWhere('cabinet_width', 'like', '%' . $search . '%')
                    ->orWhere('cabinet_height', 'like', '%' . $search . '%')
                    ->orWhereHas('vendor', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    }));
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['name', 'code', 'pixel_pitch'];
}
