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
    
    public function location_photos(){
        return $this->hasMany(LocationPhoto::class, 'company_id', 'id');
    }

    public function locations(){
        return $this->hasMany(Location::class, 'company_id', 'id');
    }
    public function quotations(){
        return $this->hasMany(Quotation::class, 'company_id', 'id');
    }
    public function sales_data(){
        return $this->hasMany(SalesData::class, 'company_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function print_install_sales(){
        return $this->hasMany(PrintInstallSale::class, 'company_id', 'id');
    }

    public function print_instal_quotations(){
        return $this->hasMany(PrintInstalQuotation::class, 'company_id', 'id');
    }

    public $sortable = ['name','code'];
}
