<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('gender', 'like', '%' . $search . '%')
                    ->orWhere('position', 'like', '%' . $search . '%')
                    ->orWhere('level', 'like', '%' . $search . '%'));
    }

    public function media_sizes(){
        return $this->hasMany(MediaSize::class, 'user_id', 'id');
    }
    public function leds(){
        return $this->hasMany(Led::class, 'user_id', 'id');
    }
    public function vendors(){
        return $this->hasMany(Vendor::class, 'user_id', 'id');
    }
    public function vendor_contacts(){
        return $this->hasMany(VendorContact::class, 'user_id', 'id');
    }
    public function vendor_categories(){
        return $this->hasMany(VendorCategory::class, 'user_id', 'id');
    }
    public function areas(){
        return $this->hasMany(Area::class, 'user_id', 'id');
    }
    public function cities(){
        return $this->hasMany(City::class, 'user_id', 'id');
    }
    public function location_photos(){
        return $this->hasMany(LocationPhoto::class, 'user_id', 'id');
    }
    public function installation_photos(){
        return $this->hasMany(InstallationPhoto::class, 'user_id', 'id');
    }
    public function media_categories(){
        return $this->hasMany(MediaCategory::class, 'user_id', 'id');
    }
    public function clients(){
        return $this->hasMany(Client::class, 'user_id', 'id');
    }
    public function client_categories(){
        return $this->hasMany(ClientCategory::class, 'user_id', 'id');
    }
    public function client_groups(){
        return $this->hasMany(ClientGroup::class, 'user_id', 'id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class, 'user_id', 'id');
    }
    public function companies(){
        return $this->hasMany(Company::class, 'user_id', 'id');
    }
    public function printing_products(){
        return $this->hasMany(PrintingProduct::class, 'user_id', 'id');
    }
    public function printing_prices(){
        return $this->hasMany(PrintingPrice::class, 'user_id', 'id');
    }
    public function installation_prices(){
        return $this->hasMany(InstallationPrice::class, 'user_id', 'id');
    }
    public function land_agreements(){
        return $this->hasMany(LandAgreement::class, 'user_id', 'id');
    }
    public function land_documents(){
        return $this->hasMany(LandDocument::class, 'user_id', 'id');
    }
    public function licenses(){
        return $this->hasMany(License::class, 'user_id', 'id');
    }
    public function license_documents(){
        return $this->hasMany(LicenseDocument::class, 'user_id', 'id');
    }
    public function licensing_categories(){
        return $this->hasMany(LicensingCategory::class, 'user_id', 'id');
    }
    public function electrical_powers(){
        return $this->hasMany(ElectricalPower::class, 'user_id', 'id');
    }
    public function electricity_top_ups(){
        return $this->hasMany(ElectricityTopUp::class, 'user_id', 'id');
    }
    public function electricity_payments(){
        return $this->hasMany(ElectricityPayment::class, 'user_id', 'id');
    }

    public function monitorings(){
        return $this->hasMany(Monitoring::class, 'user_id', 'id');
    }
    public function quotation_orders(){
        return $this->hasMany(QuotationOrder::class, 'user_id', 'id');
    }
    public function quotation_agreements(){
        return $this->hasMany(QuotationAgreement::class, 'user_id', 'id');
    }

    public function monitoring_photos(){
        return $this->hasMany(MonitoringPhoto::class, 'user_id', 'id');
    }

    public $sortable = ['name', 'username'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
