<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function sizes(){
        return $this->hasMany(Size::class, 'user_id', 'id');
    }

    public function product_categories(){
        return $this->hasMany(ProductCategory::class, 'user_id', 'id');
    }

    public function leds(){
        return $this->hasMany(Led::class, 'user_id', 'id');
    }

    public function vendors(){
        return $this->hasMany(Vendor::class, 'user_id', 'id');
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
