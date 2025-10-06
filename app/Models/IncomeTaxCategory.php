<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class IncomeTaxCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                );
    }
    
    public function income_tax_documents(){
        return $this->hasMany(IncomeTaxDocument::class, 'income_tax_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public $sortable = ['name', 'code'];
}
