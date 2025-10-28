<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Sale extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeVideotron($query){
        return $query->whereHas('media_category', function($query){
                        $query->where('name', '=', 'Videotron');
                        })
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.description.type")) like ?', ['"%' . strtolower('Videotron') . '%"']);
    }

    public function scopeActiveSale($query){
        return $query->where('end_at', '>', date('Y-m-d'));
    }

    public function scopeReceivables($query){
        if(request('client') && request('client') != 'All'){
            return $query->whereHas('quotation', function($query){
                        $query->whereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower(request('client')) . '%"']);
                    });
        }
    }

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeCustomReport($query){
        return $query->whereBetween('created_at',  [request('fromDate'), request('toDate')]);
    }

    public function scopeWeekday($query){
        if (request('weekday') == true) {
            return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)]);
        }
    }

    public function scopeMonthly($query){
        if (request('monthly') == true) {
            return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
        }
    }

    public function scopeAnnual($query){
        if (request('annual') == true) {
            return $query->whereYear('created_at', Carbon::now()->year);
        }
    }

    public function scopeYear($query){
        if(request('year')){
            return $query->whereYear('created_at', request('year'));
        }else{
            return $query->whereYear('created_at',  Carbon::now()->year);
        }
    }

    public function scopeMonthReport($query){
        if(request('month')){
            if(request('month') != 'All'){
                return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
            }
        }else{
            return $query->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month);
        }
    }

    public function scopeMonth($query){
        if(request('month')){
            if(request('month') != 'All'){
                return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
            }
        }
    }

    public function scopeArea($query){
        if (request('area') != 'All') {
                $query->whereHas('location', function($query){
                        $query->whereHas('area', function($query){
                            $query->where('area_id', 'like', '%' . request('area') . '%');
                        });
                    });
        }
    }

    public function scopeCity($query){
        if (request('city') != 'All') {
                $query->whereHas('location', function($query){
                        $query->whereHas('city', function($query){
                            $query->where('city_id', 'like', '%' . request('city') . '%');
                        });
                    });
        }
    }
    public function scopeService($query){
        return $query->where('end_at', '>', date('Y-m-d'))
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Videotron');
                    })
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Service');
                    });
    }

    public function scopePrint($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '=', 'Service');
                    });
    }

    public function scopeVoid($query){
        return $query->whereHas('void_sale', function($query){
            if(request('month')){
                if(request('month') != 'All'){
                    return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
                }
            }
        });
    }

    public function scopeChange($query){
        return $query->whereHas('change_sale', function($query){
            if(request('month')){
                if(request('month') != 'All'){
                    return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
                }
            }
        });
    }

    public function scopeBillMedia($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Service');
                    });
    }

    public function scopeWorkMedia($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Service');
                    });
    }

    public function scopeBillService($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '=', 'Service');
                    })
                    ->whereDoesntHave('billings');
    }

    public function scopeWorkService($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '=', 'Service');
                    })
                    ->whereDoesntHave('work_reports');
    }

    public function scopePrintOrder($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '=', 'Service');
                    })
                    ->whereHas('quotation', function($query){
                        $query->where('price->objServiceType->print', '=', true);
                    })
                    ->whereDoesntHave('print_order');
    }

    public function scopePrintOrderSide($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '=', 'Service');
                    })
                    ->whereHas('quotation', function($query){
                        $query->where('price->objServiceType->print', '=', true);
                    });
    }

    public function scopeInstallOrder($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '=', 'Service');
                    })
                    ->whereHas('quotation', function($query){
                        $query->where('price->objServiceType->install', '=', true);
                    })
                    ->whereDoesntHave('install_order');
    }

    public function scopeFree($query){
        return $query->where('end_at', '>', date('Y-m-d'));
    }

    public function scopeFreeInstall($query){
        return $query->whereHas('quotation', function($query){
                    $query->where('notes->freeInstall', '>', 0);
                });
    }

    public function scopeFilter($query, $filter){
        // $filter = ucfirst($filter);
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('duration', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(created_by, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.code")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.address")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.category")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.area")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(product, "$.city")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereHas('quotation', function($query) use ($search){
                        $query->whereRaw('LOWER(JSON_EXTRACT(clients, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                        ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower($search) . '%"']);
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function quotation(){
        return $this->belongsTo(Quotation::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function install_order(){
        return $this->hasOne(InstallOrder::class, 'sale_id', 'id');
    }

    public function void_sale(){
        return $this->hasOne(VoidSale::class, 'sale_id', 'id');
    }

    public function change_sale(){
        return $this->hasOne(ChangeSale::class, 'sale_id', 'id');
    }

    public function install_orders(){
        return $this->hasMany(InstallOrder::class, 'sale_id', 'id');
    }

    public function quotation_orders(){
        return $this->hasMany(QuotationOrder::class, 'sale_id', 'id');
    }

    public function quotation_agreements(){
        return $this->hasMany(QuotationAgreement::class, 'sale_id', 'id');
    }

    public function print_order(){
        return $this->hasOne(PrintOrder::class, 'sale_id', 'id');
    }

    public function print_orders(){
        return $this->hasMany(PrintOrder::class, 'sale_id', 'id');
    }

    public function work_reports(){
        return $this->hasMany(WorkReport::class, 'sale_id', 'id');
    }

    public function income_taxes(){
        return $this->hasMany(IncomeTax::class, 'sale_id', 'id');
    }

    public function billings()
    {
        return $this->belongsToMany(Billing::class, 'billing_sales');
    }
    
    public function publish_contents(){
        return $this->hasMany(PublishContent::class, 'sale_id', 'id');
    }

    public function take_out_contents(){
        return $this->hasMany(TakeOutContent::class, 'sale_id', 'id');
    }

    public function complaints(){
        return $this->hasMany(Complaint::class, 'sale_id', 'id');
    }

    public function complaint_responses(){
        return $this->hasMany(ComplaintResponse::class, 'sale_id', 'id');
    }

    public $sortable = ['number'];
}
