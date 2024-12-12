<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;


class PrintOrder extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopeTodays($query){
        if (request('todays')) {
            return $query->whereDate('created_at', request('todays'));
        }
    }

    public function scopeWeekday($query){
        if (request('weekday') == true) {
            return $query->whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)]);
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

    public function scopeSales($query){
        return $query->where('product->order_type', '=', 'sales');
    }
    public function scopeFreeSales($query){
        return $query->where('product->order_type', '=', 'free');
    }
    public function scopeFreeOther($query){
        return $query->where('product->order_type', '=', 'location');
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('theme', 'like', '%' . $search . '%')
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhereHas('sale', function($query) use ($search){
                        $query->WhereHas('quotation', function($query) use ($search){
                            $query->where('clients', 'like', '%' . $search . '%')
                            ->orWhere('products', 'like', '%' . $search . '%');
                        });
                    })
                    ->orWhereHas('vendor', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('company', 'like', '%' . $search . '%');
                    })
                );
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function location(){
        return $this->belongsTo(Location::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function install_order(){
        return $this->hasOne(InstallOrder::class, 'print_order_id', 'id');
    }

    public $sortable = ['number'];
}
