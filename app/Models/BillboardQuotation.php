<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardCategory;
use App\Models\Billboard;
use App\Models\Company;
use App\Models\Client;
use App\Models\Contact;
use App\Models\BillboardQuotRevision;
use App\Models\BillboardQuotStatus;
use Kyslik\ColumnSortable\Sortable;

class BillboardQuotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('billboards', 'like', '%' . $search . '%')
                    ->orWhereHas('client', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contact', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billboard_category(){
        return $this->belongsTo(BillboardCategory::class);
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

    public function billboard_quot_revisions(){
        return $this->hasMany(BillboardQuotRevision::class, 'billboard_quotation_id', 'id');
    }

    public function billboard_quot_statuses(){
        return $this->hasMany(BillboardQuotStatus::class, 'billboard_quotation_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'billboard_quotation_id', 'id');
    }

    public function client_approvals(){
        return $this->hasMany(ClientApproval::class, 'billboard_quotation_id', 'id');
    }

    public function client_agreements(){
        return $this->hasMany(ClientAgreement::class, 'billboard_quotation_id', 'id');
    }

    public function client_orders(){
        return $this->hasMany(ClientOrder::class, 'billboard_quotation_id', 'id');
    }

    public $sortable = ['number'];
}
