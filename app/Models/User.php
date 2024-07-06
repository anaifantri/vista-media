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

    public function sizes(){
        return $this->hasMany(Size::class, 'user_id', 'id');
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
    // public function products(){
    //     return $this->hasMany(Product::class, 'user_id', 'id');
    // }
    public function billboard_categories(){
        return $this->hasMany(BillboardCategory::class, 'user_id', 'id');
    }
    public function billboards(){
        return $this->hasMany(Billboard::class, 'user_id', 'id');
    }
    public function videotrons(){
        return $this->hasMany(Videotron::class, 'user_id', 'id');
    }
    public function signages(){
        return $this->hasMany(Signage::class, 'user_id', 'id');
    }
    public function signage_categories(){
        return $this->hasMany(SignageCategory::class, 'user_id', 'id');
    }
    public function clients(){
        return $this->hasMany(Client::class, 'user_id', 'id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class, 'user_id', 'id');
    }
    public function companies(){
        return $this->hasMany(Company::class, 'user_id', 'id');
    }
    public function billboard_quotations(){
        return $this->hasMany(BillboardQuotation::class, 'user_id', 'id');
    }
    public function billboard_quot_revisions(){
        return $this->hasMany(BillboardQuotRevision::class, 'user_id', 'id');
    }
    public function billboard_quot_statuses(){
        return $this->hasMany(BillboardQuotStatus::class, 'user_id', 'id');
    }
    public function billboard_photos(){
        return $this->hasMany(BillboardPhoto::class, 'user_id', 'id');
    }
    public function sales(){
        return $this->hasMany(Sale::class, 'user_id', 'id');
    }
    public function sale_categories(){
        return $this->hasMany(SaleCategory::class, 'user_id', 'id');
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
    public function print_instal_quotations(){
        return $this->hasMany(PrintInstalQuotation::class, 'user_id', 'id');
    }

    public function print_install_sales(){
        return $this->hasMany(PrintInstallSale::class, 'user_id', 'id');
    }

    public function print_instal_statuses(){
        return $this->hasMany(PrintInstalStatus::class, 'user_id', 'id');
    }

    public function w_o_prints(){
        return $this->hasMany(WOPrint::class, 'user_id', 'id');
    }

    public function w_o_installs(){
        return $this->hasMany(WOInstall::class, 'user_id', 'id');
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
