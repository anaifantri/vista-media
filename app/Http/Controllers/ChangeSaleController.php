<?php

namespace App\Http\Controllers;

use App\Models\ChangeSale;
use App\Models\Sale;
use App\Models\Quotation;
use App\Models\QuotationRevision;
use App\Models\MediaCategory;
use App\Models\PrintingProduct;
use App\Models\InstallationPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Carbon\Carbon;
use Validator;
use Gate;

class ChangeSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $saleId): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            $dataSale = Sale::findOrFail($saleId);
            $product = json_decode($dataSale->product);
            $category = $dataSale->media_category->name;
            $client = json_decode($dataSale->quotation->clients);
            $revision = QuotationRevision::where('quotation_id', $dataSale->quotation->id)->get()->last();
            if($revision){
                $quotation = $revision;
                $price = json_decode($revision->price);
                $notes = json_decode($revision->notes);
            } else{
                $quotation = $dataSale->quotation;
                $price = json_decode($quotation->price);
                $notes = json_decode($quotation->notes);
            }
            
            $printing_products = PrintingProduct::with('printing_prices')->get();
            
            return response()-> view ('change-sales.create', [
                'sale'=>$dataSale,
                'quotation'=>$quotation,
                'printing_products'=>PrintingProduct::all(),
                'installation_price'=>InstallationPrice::all(),
                'product'=>$product,
                'notes'=>$notes,
                'client'=>$client,
                'price'=>$price,
                'category'=>$category,
                'title' => 'Membatalkan Penjualan Nomor '.$dataSale->number,
                compact('printing_products')
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isSale') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isSale') && Gate::allows('isMarketingCreate'))){
            $request->validate([
                'images.*'=> 'image|file|mimes:jpeg,png,jpg|max:2048'
            ]);
            // dd($request);

            $validateData = $request->validate([
                'sale_id' => 'required',
                'company_id' => 'required',
                'note' => 'required',
                'price' => 'required',
                'price_diff' => 'required',
                'ppn_diff' => 'required',
                'quotation_price' => 'required',
                'dpp' => 'required',
                'ppn' => 'required',
                'duration' => 'nullable',
                'start_at' => 'nullable',
                'end_at' => 'nullable',
                'created_by' => 'required'
            ]);

            if($request->file('images')){
                $images = [];
                $getImages = $request->file('images');
                foreach($getImages as $image){
                    array_push($images,$image->store('edit-sale-images'));
                }
                $validateData['images'] = json_encode($images); 
            }

            ChangeSale::create($validateData);
                
            return redirect('/marketing/sales/home/'.$request->category.'/'.$validateData['company_id'])->with('success', 'Perubahan penjualan nomor '.$request->sale_number.' berhasil');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ChangeSale $changeSale): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChangeSale $changeSale): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChangeSale $changeSale): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChangeSale $changeSale): RedirectResponse
    {
        //
    }
}
