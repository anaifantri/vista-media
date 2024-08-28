<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class VideotronQuotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    ->orWhere('client_name', 'like', '%' . $search . '%')
                    ->orWhere('client_company', 'like', '%' . $search . '%')
                    ->orWhere('client_contact', 'like', '%' . $search . '%')
                    ->orWhere('contact_email', 'like', '%' . $search . '%')
                    ->orWhere('contact_phone', 'like', '%' . $search . '%')
                );
    }

    public function videotron(){
        return $this->belongsTo(Videotron::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    
    public function videotron_quot_statuses(){
        return $this->hasMany(VideotronQuotStatus::class, 'videotron_quot_revision_id', 'id');
    }

    public $sortable = ['number'];
}
