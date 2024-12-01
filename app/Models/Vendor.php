<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Vendor extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function scopePrint($query){
        return $query->whereHas('vendor_category', function($query){
            $query->where('name', 'like', '%Printing%');
        });
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('company', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhereHas('vendor_category', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    }));
    }

    public function leds(){
        return $this->hasMany(Led::class, 'vendor_id', 'id');
    }

    public function vendor_category(){
        return $this->belongsTo(VendorCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function vendor_contacts(){
        return $this->hasMany(VendorContact::class, 'vendor_id', 'id');
    }

    public function printing_prices(){
        return $this->hasMany(PrintingPrice::class, 'vendor_id', 'id');
    }

    public function print_orders(){
        return $this->hasMany(PrintOrder::class, 'vendor_id', 'id');
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($vendor){
    //         $vendor->leds()->get()->each->delete();
    //         $vendor->vendor_contacts()->get()->each->delete();
    //         $vendor->printing_prices()->get()->each->delete();
    //     });
    // }

    public $sortable = ['code','name','company'];
}
