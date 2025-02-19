<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class VatTaxInvoice extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function billing(){
        return $this->belongsTo(Billing::class);
    }

    public $sortable = ['number'];
}
