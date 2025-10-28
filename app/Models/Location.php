<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Location extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeVideotron($query){
        return $query->whereHas('media_category', function($query){
                        $query->where('name', '=', 'Videotron');
                        })
                    ->orWhereRaw('LOWER(JSON_EXTRACT(description, "$.type")) like ?', ['"%' . strtolower('Videotron') . '%"']);
    }

    public function scopeArea($query){
        if (request('area') != 'All') {
            return $query->where('area_id', 'like', '%' . request('area') . '%');
        }
    }

    public function scopeType($query){
        if (request('type') != 'All') {
            return $query->where('description->type', '=', request('type'));
        }
    }

    public function scopeCity($query){
        if (request('city') != 'All') {
            return $query->where('city_id', 'like', '%' . request('city') . '%');
        }
    }

    public function scopeCategory($query){
        if (request('media_category_id') != "All") {
            return $query->where('media_category_id', 'like', '%' . request('media_category_id') . '%');
        }
    }
    public function scopeCategoryName($query, $category){
        if ($category == "All") {
            return $query->whereHas('media_category', function($query){
                $query->where('name', '=', "Billboard")
                    ->orWhere('name', '=', "Baliho")
                    ->orWhere('name', '=', "Bando")
                    ->orWhere('name', '=', "Midiboard")
                ;
            });
        }else{
            return $query->whereHas('media_category', function($query) use ($category){
                $query->where('name', '=', $category);
            });
        }
    }

    public function scopeCondition($query){
        if (request('condition') != 'All') {
            return $query->where('condition', 'like', '%' . request('condition') . '%');
        }
    }

    public function scopeQuotationNew($query){
        return $query->whereHas('media_category', function($query){
            $query->where('name', '=', 'Videotron');
            })
                ->orWhereDoesntHave('active_sale')
                ->orWhereHas('end_sale_soon');
    }
    
    public function scopeQuotationExtend($query){
        return $query->whereHas('active_sale');
    }

    public function scopeTakedown($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Videotron');
                    })
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Service');
                    });
    }

    public function scopePrint($query){
        return $query->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Videotron');
                    })
                    ->whereHas('media_category', function($query){
                                    $query->where('name', '!=', 'Service');
                    })
                    ->whereDoesntHave('sales', function($query){
                        $query->where('end_at', '>', date('Y-m-d'));
                    });
    }
    
    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('condition', 'like', '%' . $search . '%')
                    ->orWhereHas('area', function($query) use ($search){
                        $query->where('area', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('city', function($query) use ($search){
                        $query->where('city', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('media_size', function($query) use ($search){
                        $query->where('size', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('land_agreements', function($query) use ($search){
                        $query->where('number', 'like', '%' . $search . '%')
                            ->orWhere('second_party', 'like', '%' . $search . '%');
                    })
                );
    }

    public function scopeActiveLicenses($query){
        return $query->whereHas('latestIpr', function($query){
                                    $query->where('end_at', '>', date('Y-m-d'))
                                    ;
                    });
    }
    public function scopeExpiredLicenses($query){
        return $query->whereHas('latestIpr', function($query){
                                    $query->where('end_at', '<', date('Y-m-d'));
                    });
    }

    public function scopeExpiredSoonLicenses($query){
        return $query->whereHas('latestIpr', function($query){
                                    $query->where('end_at', '>', date('Y-m-d'))
                                    ->where('end_at', '<', date('Y-m-d', strtotime("+30 days")));
                    });
    }

    public function scopeActiveAgreements($query){
        return $query->whereHas('latestAgreement', function($query){
                                    $query->where('end_at', '>', date('Y-m-d'))
                                    ;
                    });
    }
    public function scopeExpiredAgreements($query){
        return $query->whereHas('latestAgreement', function($query){
                                    $query->where('end_at', '<', date('Y-m-d'))
                                    ;
                    });
    }
    public function scopeExpiredSoonAgreements($query){
        return $query->whereHas('latestAgreement', function($query){
                    $query->where('end_at', '>', date('Y-m-d'))
                        ->where('end_at', '<', date('Y-m-d', strtotime("+30 days")));
                    });
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function media_size(){
        return $this->belongsTo(MediaSize::class);
    }

    public function media_category(){
        return $this->belongsTo(MediaCategory::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function location_photos(){
        return $this->hasMany(LocationPhoto::class, 'location_id', 'id');
    }
    
    public function sales(){
        return $this->hasMany(Sale::class, 'location_id', 'id');
    }

    public function active_sale(){
        return $this->hasOne(Sale::class, 'location_id', 'id')->whereHas('media_category', function($query){
            $query->where('name', '!=', 'Service');
            })
            ->where('end_at', '>', date('Y-m-d'));
    }

    public function end_sale_soon(){
        return $this->hasOne(Sale::class, 'location_id', 'id')->whereHas('media_category', function($query){
            $query->where('name', '!=', 'Service');
            })
            ->where('end_at', '<', date('Y-m-d', strtotime("+60 days")));
    }

    public function videotron_active_sales(){
        return $this->hasMany(Sale::class, 'location_id', 'id')->whereHas('media_category', function($query){
            $query->where('name', '=', 'Videotron')
                ->orWhere('name', '=', 'Signage');
            })
            ->where('end_at', '>', date('Y-m-d'));
    }

    public function latestSale() {
        return $this->hasOne(Sale::class)->latestOfMany();
    }

    public function land_agreements(){
        return $this->hasMany(LandAgreement::class, 'location_id', 'id');
    }

    public function latestAgreement(){
        return $this->hasOne(LandAgreement::class)->latestOfMany();
    }

    public function print_orders(){
        return $this->hasMany(PrintOrder::class, 'location_id', 'id');
    }

    public function install_orders(){
        return $this->hasMany(InstallOrder::class, 'location_id', 'id');
    }

    public function takedown_orders(){
        return $this->hasMany(TakedownOrder::class, 'location_id', 'id');
    }

    public function licenses(){
        return $this->hasMany(License::class, 'location_id', 'id');
    }

    public function latestIpr() {
        return $this->hasOne(License::class)->whereHas('licensing_category', function($query){
                $query->where('name', '=', 'IPR');
            })->latestOfMany();
    }

    public function electrical_powers()
    {
        return $this->belongsToMany(ElectricalPower::class, 'electrical_locations');
    }

    public function monitorings(){
        return $this->hasMany(Monitoring::class, 'location_id', 'id');
    }

    public function publish_contents(){
        return $this->hasMany(PublishContent::class, 'location_id', 'id');
    }

    public function take_out_contents(){
        return $this->hasMany(TakeOutContent::class, 'location_id', 'id');
    }

    public function complaints(){
        return $this->hasMany(Complaint::class, 'location_id', 'id');
    }

    public function complaint_responses(){
        return $this->hasMany(ComplaintResponse::class, 'location_id', 'id');
    }

    // public static function boot(){
    //     parent::boot();

    //     static::deleting(function($location){
    //         $location->location_photos()->get()->each->delete();
    //         $location->sales()->get()->each->delete();
    //     });
    // }

    public $sortable = ['code',
                        'price'
                        ];
}
