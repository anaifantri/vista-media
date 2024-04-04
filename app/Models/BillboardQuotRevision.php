<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardQuotation;
use App\Models\Sale;
use Kyslik\ColumnSortable\Sortable;

class BillboardQuotRevision extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('billboards', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billboard_quotation(){
        return $this->belongsTo(BillboardQuotation::class);
    }

    public function billboard_quot_statuses(){
        return $this->hasMany(BillboardQuotStatus::class, 'billboard_quot_revision_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'billboard_quot_revision_id', 'id');
    }

    public function client_approvals(){
        return $this->hasMany(ClientApproval::class, 'billboard_quot_revision_id', 'id');
    }

    public function client_agreements(){
        return $this->hasMany(ClientAgreement::class, 'billboard_quot_revision_id', 'id');
    }

    public function client_orders(){
        return $this->hasMany(ClientOrder::class, 'billboard_quot_revision_id', 'id');
    }

    public $sortable = ['number'];
}
