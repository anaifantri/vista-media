<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Signage;

class SignageCategory extends Model
{
    protected $guarded = ['id'];

    public function signages(){
        return $this->hasMany(Signage::class, 'signage_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
