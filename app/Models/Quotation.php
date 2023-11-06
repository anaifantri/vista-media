<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuotationCategory;
use App\Models\Product;
use App\Models\Videotron;
use App\Models\Signage;
use App\Models\Client;
use App\Models\Contact;
use Kyslik\ColumnSortable\Sortable;

class Quotation extends Model
{
    use Sortable;

    protected $guarded = ['id'];

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, fn($query, $search) => 
                $query->where('number', 'like', '%' . $search . '%')
                    ->orWhere('products', 'like', '%' . $search . '%')
                    ->orWhereHas('client', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('contact', function($query) use ($search){
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('quotation_category', function($query) use ($search){
                        $query->where('', 'name', '%' . $search . '%');
                    })
                    ->orWhereHas('product', function($query) use ($search){
                        $query->where('', 'code', '%' . $search . '%');
                        $query->where('', 'address', '%' . $search . '%');
                    })
                    ->orWhereHas('videotron', function($query) use ($search){
                        $query->where('', 'code', '%' . $search . '%');
                        $query->where('', 'address', '%' . $search . '%');
                    })
                    ->orWhereHas('signage', function($query) use ($search){
                        $query->where('', 'code', '%' . $search . '%');
                        $query->where('', 'address', '%' . $search . '%');
                    })
                );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotation_category(){
        return $this->belongsTo(QuotationCategory::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function videotron(){
        return $this->belongsTo(Videotron::class);
    }

    public function signage(){
        return $this->belongsTo(Signage::class);
    }


    public $sortable = ['number'];
}
