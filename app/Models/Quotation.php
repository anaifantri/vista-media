<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Quotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }

    public function scopeTodays($query){
        if (request('todays')) {
            return $query->whereDate('created_at', request('todays'));
        }
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

    public function scopeMonth($query){
        if(request('month')){
            if(request('month') != 'All'){
                return $query->whereYear('created_at', request('year'))->whereMonth('created_at', request('month'));
            }
        }
    }

    public function scopeDealSales($query){
        return $query->whereDoesntHave('sales');
    }

    public function scopeDeal($query){
        return $query->whereHas('quot_revision_status', function($query){
            $query->where('status', '=', 'Deal');
        })
        ->orWhereDoesntHave('quot_revision_status')
        ->whereHas('quotation_status', function($query){
            $query->where('status', '=', 'Deal');
        });
    }

    public function scopeCreateds($query){
        return $query->whereHas('quot_revision_status', function($query){
            $query->where('status', '=', 'Created');
        })
        ->orWhereDoesntHave('quot_revision_status')
        ->whereHas('quotation_status', function($query){
            $query->where('status', '=', 'Created');
        });
    }

    public function scopeClosed($query){
        return $query->whereHas('quot_revision_status', function($query){
            $query->where('status', '=', 'Closed');
        })
        ->orWhereDoesntHave('quot_revision_status')
        ->whereHas('quotation_status', function($query){
            $query->where('status', '=', 'Closed');
        });
    }

    public function scopeSent($query){
        return $query->whereHas('quot_revision_status', function($query){
            $query->where('status', '=', 'Sent');
        })
        ->orWhereDoesntHave('quot_revision_status')
        ->whereHas('quotation_status', function($query){
            $query->where('status', '=', 'Sent');
        });
    }

    public function scopeFollowUp($query){
        return $query->whereHas('quot_revision_status', function($query){
            $query->where('status', '=', 'Follow Up');
        })
        ->orWhereDoesntHave('quot_revision_status')
        ->whereHas('quotation_status', function($query){
            $query->where('status', '=', 'Follow Up');
        });
}

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(clients, "$.company")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhereRaw('LOWER(JSON_EXTRACT(created_by, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereRaw('LOWER(JSON_EXTRACT(modified_by, "$.name")) like ?', ['"%' . strtolower($search) . '%"'])
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

    // public function client(){
    //     return $this->belongsTo(Client::class);
    // }

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
