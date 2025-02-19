<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class BillCoverLetter extends Model
{
    use Sortable;
    protected $guarded = ['id'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public $sortable = ['number'];
}
