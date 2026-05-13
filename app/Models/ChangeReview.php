<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeReview extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function change_sale(){
        return $this->belongsTo(ChangeSale::class);
    }
}
