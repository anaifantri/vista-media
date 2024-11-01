<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class LicensingCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%'));
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function license_documents(){
        return $this->hasMany(LicenseDocument::class, 'licensing_category_id', 'id');
    }

    public function licenses(){
        return $this->hasMany(License::class, 'licensing_category_id', 'id');
    }

    public $sortable = ['name', 'code'];
}
