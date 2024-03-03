<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAgreement extends Model
{
    protected $guarded = ['id'];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
