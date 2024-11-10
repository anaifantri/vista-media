<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ClientCategory extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%'));
    }

    public function clients(){
        return $this->hasMany(Client::class, 'client_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($company){
    //         $company->clients()->get()->each->delete();
    //     });
    // }

    public $sortable = ['name', 'code'];
}
