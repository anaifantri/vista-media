<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesReview extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
