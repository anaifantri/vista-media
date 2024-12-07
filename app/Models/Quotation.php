<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Quotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('quot_revision_statuses', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeDeal($query){
            return $query->whereHas('quotation_status', function($query){
                $query->where('status', '=', 'Deal');
            })
            ->orWhereHas('quot_revision_status', function($query){
                $query->where('status', '=', 'Deal');
            });
    }

    public function scopeClosed($query){
            return $query->whereHas('quot_revision_status', function($query){
                $query->where('status', '=', 'Closed');
            })
            ->whereHas('quotation_status', function($query){
                $query->where('status', '=', 'Closed');
            });
    }

    public function scopeSent($query){
            return $query->whereHas('quotation_status', function($query){
                $query->where('status', '=', 'Sent');
            })
            ->whereHas('quot_revision_status', function($query){
                $query->where('status', '=', 'Sent');
            });
    }

    public function scopeFollowUp($query){
        return $query->whereHas('quot_revision_status', function($query){
            $query->where('status', '=', 'Follow Up');
        })
        // ->orWhereDoesntHave('quot_revision_status')
        ->whereHas('quotation_status', function($query){
            $query->where('status', '=', 'Follow Up');
        });
}

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    ->orWhere('clients', 'like', '%' . $search . '%')
                    ->orWhere('created_by', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('modified_by', 'like', '%' . $search . '%')
                );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function quotation_revisions(){
        return $this->hasMany(QuotationRevision::class, 'quotation_id', 'id');
    }
    public function sales(){
        return $this->hasMany(Sale::class, 'quotation_id', 'id');
    }

    public function quotation_statuses(){
        return $this->hasMany(QuotationStatus::class, 'quotation_id', 'id');
    }

    public function quotation_status(){
        return $this->hasOne(QuotationStatus::class)->latestOfMany();
    }

    public function quot_revision_statuses(){
        return $this->hasMany(QuotRevisionStatus::class, 'quotation_id', 'id');
    }

    public function quot_revision_status(){
        return $this->hasOne(QuotRevisionStatus::class)->latestOfMany();
    }

    public function quotation_approvals(){
        return $this->hasMany(QuotationApproval::class, 'quotation_id', 'id');
    }
    public function quotation_agreements(){
        return $this->hasMany(QuotationAgreement::class, 'quotation_id', 'id');
    }
    public function quotation_orders(){
        return $this->hasMany(QuotationOrder::class, 'quotation_id', 'id');
    }

    public $sortable = ['number'];
}
