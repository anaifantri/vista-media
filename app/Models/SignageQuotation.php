<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SignageQuotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    ->orWhere('client_name', 'like', '%' . $search . '%')
                    ->orWhere('client_company', 'like', '%' . $search . '%')
                    ->orWhere('client_contact', 'like', '%' . $search . '%')
                    ->orWhere('contact_email', 'like', '%' . $search . '%')
                    ->orWhere('contact_phone', 'like', '%' . $search . '%')
                );
    }

    public function signage(){
        return $this->belongsTo(Signage::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function signage_quot_statuses(){
        return $this->hasMany(SignageQuotStatus::class, 'signage_quotation_id', 'id');
    }

    public function signage_approvals(){
        return $this->hasMany(SignageApproval::class, 'signage_quotation_id', 'id');
    }

    public function signage_orders(){
        return $this->hasMany(SignageOrder::class, 'signage_quotation_id', 'id');
    }

    public function signage_agreements(){
        return $this->hasMany(SignageAgreement::class, 'signage_quotation_id', 'id');
    }

    public function signage_quot_revisions(){
        return $this->hasMany(SignageQuotRevision::class, 'signage_quotation_id', 'id');
    }

    public $sortable = ['number'];
}
