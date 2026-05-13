<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoidReview extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function void_sale(){
        return $this->belongsTo(VoidSale::class);
    }
}
