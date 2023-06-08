<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\City;
use App\Models\Size;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $sortable = ['code',
                        'price',
                        'start_contract',
                        'end_contract'
                        ];
}
