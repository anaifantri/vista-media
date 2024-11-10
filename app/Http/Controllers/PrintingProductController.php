<?php

namespace App\Http\Controllers;

use App\Models\PrintingProduct;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Gate;

class PrintingProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(Gate::allows('isMarketingSetting') && Gate::allows('isMarketingRead')){
            return response()-> view ('printing-products.index', [
                'printing_products'=>PrintingProduct::filter(request('search'))->sortable()->with(['user'])->orderBy("name", "asc")->paginate(10)->withQueryString(),
                'title' => 'Daftar Bahan Cetak'
            ]);
        } else {
            abort(403);
        }
    }

    public function showPrintProduct(){
        $dataPrintProduct = PrintingProduct::All();

        return response()->json(['dataPrintProduct'=> $dataPrintProduct]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingCreate')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingCreate'))){
            return response()-> view ('printing-products.create', [
                'title' => 'Menambahkan Data Bahan Cetak'
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
        
            if ($request->type == 'pilih'){
                return back()->withErrors(['type' => ['Silahkan pilih type bahan']])->withInput();
            }

            // Set code --> start
            $dataProduct = PrintingProduct::all()->last();
            if($dataProduct){
                $lastCode = (int)substr($dataProduct->code,3,3);
                $newCode = $lastCode + 1;
            } else {
                $newCode = 1;
            }
            
    
            if($newCode < 10 ){
                $code = 'PP-00'.$newCode;
            } else {
                $code = 'PP-0'.$newCode;
            }
            // Set code --> end

            $request->request->add(['code' => $code, 'user_id' => auth()->user()->id]);
            $validateData = $request->validate([
                'code' => 'required|unique:printing_products',
                'name' => 'required|unique:printing_products',
                'user_id' => 'required',
                'type' => 'required',
                'price' => 'required',
                'description' => 'nullable'
            ]);
            
            PrintingProduct::create($validateData);
    
            return redirect('/marketing/printing-products')->with('success','Bahan cetak dengan nama '. $request->name . ' berhasil ditambahkan');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintingProduct $printingProduct): Response
    {
        if(Gate::allows('isMarketingSetting') && Gate::allows('isMarketingRead')){
            return response()-> view ('printing-products.show', [
                'printing_product' => $printingProduct,
                'title' => 'Detail Data Bahan ' . $printingProduct->name
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintingProduct $printingProduct): Response
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit'))){
            return response()->view('printing-products.edit', [
                'printing_product' => $printingProduct,
                'title' => 'Edit Data Bahan Cetak'
            ]);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintingProduct $printingProduct): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingEdit'))){
            $request->request->add(['user_id' => auth()->user()->id]);
            $rules = [
                'user_id' => 'required',
                'type' => 'required',
                'price' => 'required',
                'description' => 'nullable'
            ];
            if ($request->name != $printingProduct->name) {
                $rules['name'] = 'required|unique:printing_products';
            }
            $validateData = $request->validate($rules);
                
            PrintingProduct::where('id', $printingProduct->id)
                ->update($validateData);
        
            return redirect('/marketing/printing-products')->with('success','Bahan cetak dengan nama '. $printingProduct->name . ' berhasil dirubah');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintingProduct $printingProduct): RedirectResponse
    {
        if((Gate::allows('isAdmin') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingDelete')) || (Gate::allows('isMarketing') && Gate::allows('isMarketingSetting') && Gate::allows('isMarketingDelete'))){
            if($printingProduct->printing_prices()->exists()){
                return back()->withErrors(['delete' => ['Gagal untuk menghapus data bahan cetak, terdapat relasi dengan data pada tabel data lainnya']]);
            }else{
                PrintingProduct::destroy($printingProduct->id);
    
                return redirect('/marketing/printing-products')->with('success','Bahan cetak dengan nama '. $printingProduct->name .' berhasil dihapus');
            }
        } else {
            abort(403);
        }
    }
}
