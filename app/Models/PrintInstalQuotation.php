<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PrintInstalQuotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    ->orWhereHas('client', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contact', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('sale', function($query) use ($search){
                        $query->where('number', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function print_instal_statuses(){
        return $this->hasMany(PrintInstalStatus::class, 'print_instal_quotation_id', 'id');
    }

    public function w_o_prints(){
        return $this->hasMany(WOPrint::class, 'print_instal_quotation_id', 'id');
    }

    public function w_o_installs(){
        return $this->hasMany(WOInstall::class, 'print_instal_quotation_id', 'id');
    }

    public $sortable = ['number'];
}
