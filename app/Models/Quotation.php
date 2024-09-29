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
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    // ->orWhereHas('client', function($query) use ($search){
                    //     $query->where('name', 'like', '%' . $search . '%');
                    // })
                    // ->orWhereHas('contact', function($query) use ($search){
                    //     $query->where('name', 'like', '%' . $search . '%');
                    // })
                    // ->orWhereHas('quotation_category', function($query) use ($search){
                    //     $query->where('', 'name', '%' . $search . '%');
                    // })
                    // ->orWhereHas('product', function($query) use ($search){
                    //     $query->where('', 'code', '%' . $search . '%');
                    //     $query->where('', 'address', '%' . $search . '%');
                    // })
                    // ->orWhereHas('videotron', function($query) use ($search){
                    //     $query->where('', 'code', '%' . $search . '%');
                    //     $query->where('', 'address', '%' . $search . '%');
                    // })
                    // ->orWhereHas('signage', function($query) use ($search){
                    //     $query->where('', 'code', '%' . $search . '%');
                    //     $query->where('', 'address', '%' . $search . '%');
                    // })
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
    public function sales_data(){
        return $this->hasMany(SalesData::class, 'quotation_id', 'id');
    }

    public function quotation_statuses(){
        return $this->hasMany(QuotationStatus::class, 'quotation_id', 'id');
    }

    public function quot_revision_statuses(){
        return $this->hasMany(QuotRevisionStatus::class, 'quotation_id', 'id');
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
