<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Billing extends Model
{
    use Sortable;
    protected $guarded = ['id'];
        
    public function scopeYear($query){
        if(request('year')){
            return $query->whereYear('created_at', request('year'));
        }else{
            return $query->whereYear('created_at',  Carbon::now()->year);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
        }else{
            return $query->whereYear('created_at',  Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
        }
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('invoice_number', 'like', '%' . $search . '%')
                    ->orWhere('invoice_content', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(client, "$.company")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereHas('sales', function($query) use ($search){
                        $query->where('number', 'like', '%' . $search . '%');
                    })
                );
    }
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function vat_tax_invoice(){
        return $this->hasOne(VatTaxInvoice::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'billing_sales');
    }

    public function bill_cover_letters()
    {
        return $this->belongsToMany(BillCoverLetter::class, 'billing_letters');
    }

    public function bill_payments()
    {
        return $this->belongsToMany(Payment::class, 'billing_payments');
    }
    
    public function income_taxes(){
        return $this->hasMany(IncomeTax::class, 'billing_id', 'id');
    }

    public $sortable = ['invoice_number', 'receipt_number'];
}
