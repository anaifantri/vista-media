<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardPhoto;
use App\Models\BillboardQuotation;
use App\Models\Sale;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%'));
    }
    
    public function billboard_photos(){
        return $this->hasMany(BillboardPhoto::class, 'company_id', 'id');
    }

    public function billboard_quotations(){
        return $this->hasMany(BillboardQuotation::class, 'company_id', 'id');
    }

    public function videotron_quotations(){
        return $this->hasMany(VideotronQuotation::class, 'company_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'company_id', 'id');
    }

    public function print_install_sales(){
        return $this->hasMany(PrintInstallSale::class, 'company_id', 'id');
    }

    public function print_instal_quotations(){
        return $this->hasMany(PrintInstalQuotation::class, 'company_id', 'id');
    }

    public $sortable = ['name','code'];
}
