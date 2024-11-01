<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseDocument extends Model
{
    protected $guarded = ['id'];

    public function license(){
        return $this->belongsTo(License::class);
    }

    public function licensing_category(){
        return $this->belongsTo(LicensingCategory::class);
    }
}
