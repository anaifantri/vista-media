<?php

namespace App\Http\Controllers;

use App\Models\PrintingPrice;
use App\Models\PrintingProduct;
use App\Models\Vendor;
use App\Models\User;
use App\Models\VendorCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PrintingPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $printing_products = PrintingProduct::with('printing_prices')->get();
        $vendors = Vendor::with('printing_prices')->get();

        return response()-> view ('dashboard.media.printing-prices.index', [
            'printing_prices'=>PrintingPrice::filter(request('search'))->with(['user'])->paginate(10)->withQueryString(),
            'title' => 'Daftar Harga Cetak',
            compact('vendors', 'printing_products')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()-> view ('dashboard.media.printing-prices.create', [
                'printing_products'=>PrintingProduct::all(),
                'vendors'=>Vendor::all(),
                'vendor_categories'=>VendorCategory::all(),
                'title' => 'Create Printing Price'
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
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            if ($request->printing_product_id == 'Pilih Bahan'){
                return back()->withErrors(['printing_product_id' => ['Silahkan pilih bahan']])->withInput();
            }

            if ($request->vendor_id == 'Pilih Vendor'){
                return back()->withErrors(['vendor_id' => ['Silahkan pilih vendor']])->withInput();
            }

            $priceData = PrintingPrice::all();
            foreach($priceData as $price){
                if($price->printing_product_id == $request->printing_product_id && $price->vendor_id == $request->vendor_id){
                    return back()->withErrors(['printing_product_id' => ['Nama bahan dengan vendor yang sama sudah terdaftar, silahkan pilih bahan/vendor yang lain']])->withInput();
                }
            }
            
            $validateData = $request->validate([
                'vendor_id' => 'required',
                'printing_product_id' => 'required',
                'price' => 'required'
            ]);

            $data_printing_products = PrintingProduct::all();
            foreach($data_printing_products as $printing_product){
                if($printing_product->id == $request->printing_product_id){
                    $printing_product_name = $printing_product->name;
                }
            }
            
            $validateData['user_id'] = auth()->user()->id;
            PrintingPrice::create($validateData);
    
            return redirect('/dashboard/media/printing-prices')->with('success','Harga cetak dengan bahan '. $printing_product_name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintingPrice $printingPrice): Response
    {
        return response()-> view ('dashboard.media.printing-prices.show', [
            'printing_price' => $printingPrice,
            'title' => 'Detail Harga ' . $printingPrice->printing_product->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintingPrice $printingPrice): Response
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            return response()->view('dashboard.media.printing-prices.edit', [
                'printing_price' => $printingPrice,
                'printing_products'=>PrintingProduct::all(),
                'vendors'=>Vendor::all(),
                'vendor_categories'=>VendorCategory::all(),
                'title' => 'Edit Harga Cetak'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintingPrice $printingPrice): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            
            $validateData = $request->validate([
                'vendor_id' => 'required',
                'printing_product_id' => 'required',
                'price' => 'required'
            ]);
                
            $validateData['user_id'] = auth()->user()->id;
                
            PrintingPrice::where('id', $printingPrice->id)
                ->update($validateData);
        
            return redirect('/dashboard/media/printing-prices')->with('success','Harga cahan cetak dengan nama '. $printingPrice->printing_product->name . ' berhasil diupdate');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintingPrice $printingPrice): RedirectResponse
    {
        if(auth()->user()->level === 'Administrator' || auth()->user()->level === 'Media'){
            PrintingPrice::destroy($printingPrice->id);

            return redirect('/dashboard/media/printing-prices')->with('success','Bahan cetak dengan nama '. $printingPrice->printing_product->name .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
