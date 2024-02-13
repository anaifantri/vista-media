<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Billboard;

class BillboardCategory extends Model
{
    protected $guarded = ['id'];

    public function billboards(){
        return $this->hasMany(Billboard::class, 'billboard_category_id', 'id');
    }

    // public function billboard_categories(){
    //     return $this->hasMany(BillboardCategory::class, 'billboard_category_id', 'id');
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
