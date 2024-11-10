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
use Gate;

class PrintingPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMarketingSetting') && Gate::allows('isMarketingRead')){
            $printing_products = PrintingProduct::with('printing_prices')->get();
            $vendors = Vendor::with('printing_prices')->get();
    
            return response()-> view ('printing-prices.index', [
                'printing_prices'=>PrintingPrice::filter(request('search'))->sortable()->with(['user'])->orderBy("code", "asc")->paginate(10)->withQueryString(),
                'title' => 'Daftar Harga Cetak',
                compact('vendors', 'printing_products')
            ]);
        } else {
            abort(403);
        }
    }

    public function showPrintPrice(){
        $dataPrintPrice = PrintingPrice::All();

        return response()->json(['dataPrintPrice'=> $dataPrintPrice]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingCreate'))){
            return response()-> view ('printing-prices.create', [
                'printing_products'=>PrintingProduct::all(),
                'vendors'=>Vendor::all(),
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
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingCreate'))){
            if ($request->printing_product_id == 'pilih'){
                return back()->withErrors(['printing_product_id' => ['Silahkan pilih bahan']])->withInput();
            }
            if ($request->vendor_id == 'pilih'){
                return back()->withErrors(['vendor_id' => ['Silahkan pilih vendor']])->withInput();
            }
            $priceData = PrintingPrice::where('printing_product_id', $request->printing_product_id)->where('vendor_id', $request->vendor_id)->get()->last();
            
            if($priceData){
                return back()->withErrors(['printing_product_id' => ['Nama bahan dengan vendor yang sama sudah terdaftar, silahkan pilih bahan/vendor yang lain']])->withInput();
            }

            // Set code --> start
            $dataPrice = PrintingPrice::all()->last();
            if($dataPrice){
                $lastCode = (int)substr($dataPrice->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'PR-00'.$newCode;
            } else {
                $code = 'PR-0'.$newCode;
            }
            // Set code --> end
            
            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:printing_prices',
                'user_id' => 'required',
                'vendor_id' => 'required',
                'printing_product_id' => 'required',
                'price' => 'required'
            ]);
            
            PrintingPrice::create($validateData);
    
            return redirect('/marketing/printing-prices')->with('success','Harga cetak dengan kode '. $code . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintingPrice $printingPrice): Response
    {
        if(Gate::allows('isMarketingSetting') && Gate::allows('isMarketingRead')){
            return response()-> view ('printing-prices.show', [
                'printing_price' => $printingPrice,
                'title' => 'Detail Harga Cetak '
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintingPrice $printingPrice): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit'))){
            return response()->view('printing-prices.edit', [
                'printing_price' => $printingPrice,
                'printing_products'=>PrintingProduct::all(),
                'vendors'=>Vendor::all(),
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
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit'))){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'price' => 'required'
            ];
            
            $validateData = $request->validate($rules);
                
            PrintingPrice::where('id', $printingPrice->id)
                ->update($validateData);
        
            return redirect('/marketing/printing-prices')->with('success','Harga cetak dengan kode '. $printingPrice->code . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintingPrice $printingPrice): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingDelete'))){
            PrintingPrice::destroy($printingPrice->id);

            return redirect('/marketing/printing-prices')->with('success','Harga cetak dengan kode '. $printingPrice->code .' berhasil dihapus');
        } else {
            abort(403);
        }
    }
}
