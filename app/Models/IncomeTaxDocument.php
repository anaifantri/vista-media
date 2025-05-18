<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class IncomeTaxDocument extends Model
{
    use Sortable;
    protected $guarded = ['id'];
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function billing(){
        return $this->belongsTo(Payment::class);
    }
    
    public $sortable = ['number'];
}
