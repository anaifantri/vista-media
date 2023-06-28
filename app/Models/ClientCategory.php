<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCategory extends Model
{
    protected $guarded = ['id'];

    public function clients(){
        return $this->hasMany(Client::class, 'client_category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
