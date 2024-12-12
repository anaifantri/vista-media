<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhereHas('client_category', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }

    public function contacts(){
        return $this->hasMany(Contact::class, 'client_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client_category(){
        return $this->belongsTo(ClientCategory::class);
    }

    // public function quotations(){
    //     return $this->hasMany(Quotation::class, 'client_id', 'id');
    // }

    // public function sales(){
    //     return $this->hasMany(Sale::class, 'client_id', 'id');
    // }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($client){
    //         $client->contacts()->get()->each->delete();
    //     });
    // }

    public $sortable = ['code','name','company'];
}
