<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PrintInstallSale extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('client', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('company', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('company', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('billboard', function($query) use ($search){
                        $query->where('code', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
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

    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function billboard(){
        return $this->belongsTo(Billboard::class);
    }

    public function print_instal_quotation(){
        return $this->belongsTo(PrintInstalQuotation::class);
    }

    public function w_o_prints(){
        return $this->hasMany(WOPrint::class, 'print_install_sale_id', 'id');
    }

    public function w_o_installs(){
        return $this->hasMany(WOInstall::class, 'print_install_sale_id', 'id');
    }
}
