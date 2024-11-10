<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Monitoring extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function monitoring_photos(){
        return $this->hasMany(MonitoringPhoto::class, 'monitoring_id', 'id');
    }

    public $sortable = ['monitoring_date', 'month'];
}
