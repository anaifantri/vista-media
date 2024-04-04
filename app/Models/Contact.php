<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotations(){
        return $this->hasMany(Quotation::class, 'contact_id', 'id');
    }

    public function billboard_quotations(){
        return $this->hasMany(BillboardQuotation::class, 'contact_id', 'id');
    }

    public function sales(){
        return $this->hasMany(Sale::class, 'contact_id', 'id');
    }
}
