<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillboardCategory;
use App\Models\Billboard;
use App\Models\Company;
use App\Models\Client;
use App\Models\Contact;
use App\Models\BillboardQuoteRevision;
use Kyslik\ColumnSortable\Sortable;

class BillboardQuotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('billboards', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhereHas('client', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contact', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                );
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function billboard_category(){
        return $this->belongsTo(BillboardCategory::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function billboard(){
        return $this->belongsTo(Billboard::class);
    }

    public function billboard_quote_revision(){
        return $this->hasMany(BillboardQuoteRevision::class, 'billboard_quotation_id', 'id');
    }

    public $sortable = ['number'];
}
