<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

use App\Models\Billboard;
use App\Models\Company;
use App\Models\Client;
use App\Models\BillboardQuotation;
use App\Models\BillboardQuotRevision;

class Sale extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('duration', 'like', '%' . $search . '%')
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

    public function billboard(){
        return $this->belongsTo(Billboard::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function sale_category(){
        return $this->belongsTo(SaleCategory::class);
    }

    public function billboard_quotation(){
        return $this->belongsTo(BillboardQuotation::class);
    }

    public function billboard_quot_revision(){
        return $this->belongsTo(BillboardQuotRevision::class);
    }

    public function client_approvals(){
        return $this->hasMany(ClientApproval::class, 'sale_id', 'id');
    }

    public function client_orders(){
        return $this->hasMany(ClientOrder::class, 'sale_id', 'id');
    }

    public function client_agreements(){
        return $this->hasMany(ClientAgreement::class, 'sale_id', 'id');
    }

    public function w_o_prints(){
        return $this->hasMany(WOPrint::class, 'sale_id', 'id');
    }

    public function w_o_installs(){
        return $this->hasMany(WOInstall::class, 'sale_id', 'id');
    }

    public $sortable = ['number'];
}
