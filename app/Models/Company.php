<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('m_phone', 'like', '%' . $search . '%')
                );
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

    public function sales(){
        return $this->hasMany(Sale::class, 'company_id', 'id');
    }

    public function bill_cover_letters(){
        return $this->hasMany(BillCoverLetter::class, 'company_id', 'id');
    }

    public function work_reports(){
        return $this->hasMany(WorkReport::class, 'company_id', 'id');
    }

    public function vat_tax_invoices(){
        return $this->hasMany(VatTaxInvoice::class, 'company_id', 'id');
    }

    public function billings(){
        return $this->hasMany(Billing::class, 'company_id', 'id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'company_id', 'id');
    }

    public function other_fees(){
        return $this->hasMany(Payment::class, 'company_id', 'id');
    }

    public function print_orders(){
        return $this->hasMany(PrintOrder::class, 'company_id', 'id');
    }

    public function install_orders(){
        return $this->hasMany(InstallOrder::class, 'company_id', 'id');
    }

    public function land_agreements(){
        return $this->hasMany(LandAgreement::class, 'company_id', 'id');
    }
    public function licenses(){
        return $this->hasMany(License::class, 'company_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function takedown_orders(){
        return $this->hasMany(TakedownOrder::class, 'company_id', 'id');
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($company){
    //         $company->locations()->get()->each->delete();
    //         $company->location_photos()->get()->each->delete();
    //         $company->quotations()->get()->each->delete();
    //         $company->sales()->get()->each->delete();
    //         $company->print_orders()->get()->each->delete();
    //         $company->install_orders()->get()->each->delete();
    //     });
    // }

    public $sortable = ['name','code'];
}
